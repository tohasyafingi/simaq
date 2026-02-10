<?php

namespace App\Services;

use Google\Client;
use Google\Service\AnalyticsData;
use Google\Service\AnalyticsData\RunReportRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GoogleAnalyticsService
{
    protected Client $client;
    protected AnalyticsData $analytics;
    protected ?string $lastError = null;

    public function __construct()
    {
        $this->client = new Client();

        $credentialsPath = config('analytics.service_account_credentials_json') ?: storage_path('app/ga4-service-account.json');
        if (file_exists($credentialsPath)) {
            $this->client->setAuthConfig($credentialsPath);
        }

        $this->client->addScope(AnalyticsData::ANALYTICS_READONLY);

        $this->analytics = new AnalyticsData($this->client);
    }

    protected function propertyPath(): ?string
    {
        $propertyId = config('analytics.property_id') ?: env('ANALYTICS_PROPERTY_ID');
        $propertyId = is_string($propertyId) ? trim($propertyId) : $propertyId;
        if (empty($propertyId)) {
            return null;
        }

        // GA4 expects the property resource name like: properties/123456789
        return str_starts_with($propertyId, 'properties/') ? $propertyId : 'properties/' . $propertyId;
    }

    protected function runReport(array $metrics, string $startDate = '7daysAgo', string $endDate = 'today')
    {
        $property = $this->propertyPath();
        if (!$property) {
            return null;
        }

        $metricObjects = array_map(fn($name) => ['name' => $name], $metrics);

        try {
            $body = [
                'dateRanges' => [
                    ['startDate' => $startDate, 'endDate' => $endDate],
                ],
                'metrics' => $metricObjects,
            ];

            $request = new RunReportRequest($body);

            return $this->analytics->properties->runReport($property, $request);
        } catch (\Exception $e) {
            $this->lastError = $e->getMessage();
            Log::warning('GA4 runReport failed', [
                'property' => $property,
                'metrics' => $metrics,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    public function getLastError(): ?string
    {
        return $this->lastError;
    }

    protected function rowsFromResponse($response): array
    {
        if (!$response) {
            return [];
        }

        if (method_exists($response, 'getRows')) {
            return $response->getRows() ?: [];
        }

        if (property_exists($response, 'rows')) {
            return $response->rows ?? [];
        }

        return [];
    }

    protected function metricValue($row, int $index): int
    {
        $values = [];
        if (method_exists($row, 'getMetricValues')) {
            $values = $row->getMetricValues() ?: [];
        } elseif (property_exists($row, 'metricValues')) {
            $values = $row->metricValues ?? [];
        }

        if (isset($values[$index]->value)) {
            return (int) $values[$index]->value;
        }

        return 0;
    }

    protected function dimensionValue($row, int $index): ?string
    {
        $values = [];
        if (method_exists($row, 'getDimensionValues')) {
            $values = $row->getDimensionValues() ?: [];
        } elseif (property_exists($row, 'dimensionValues')) {
            $values = $row->dimensionValues ?? [];
        }

        return $values[$index]->value ?? null;
    }

    public function getVisitorsAndPageViews(int $days = 7): array
    {
        $property = $this->propertyPath();
        if (!$property) {
            return ['visitors' => 0, 'pageViews' => 0];
        }

        $cacheKey = "ga:totals:{$property}:{$days}";

        $cached = Cache::get($cacheKey);
        if ($cached !== null) {
            return $cached;
        }

        $start = $days . 'daysAgo';
        $response = $this->runReport(['activeUsers', 'screenPageViews'], $start, 'today');
        if (!$response) {
            return ['visitors' => 0, 'pageViews' => 0];
        }

        $visitors = 0;
        $pageViews = 0;

        foreach ($this->rowsFromResponse($response) as $row) {
            $visitors += $this->metricValue($row, 0);
            $pageViews += $this->metricValue($row, 1);
        }

        $result = ['visitors' => $visitors, 'pageViews' => $pageViews];
        Cache::put($cacheKey, $result, 600);

        return $result;
    }

    /**
     * Return daily breakdown for the past N days.
     *
     * @return array [labels => [], visitors => [], pageViews => []]
     */
    public function getDailyVisitorsAndPageViews(int $days = 7, string $aggregate = 'day'): array
    {
        $start = $days . 'daysAgo';

        // Request dimensions=date to get per-day rows
        $property = $this->propertyPath();
        if (!$property) {
            return ['labels' => [], 'visitors' => [], 'pageViews' => []];
        }

        $body = [
            'dateRanges' => [
                ['startDate' => $start, 'endDate' => 'today'],
            ],
            'dimensions' => [['name' => 'date']],
            'metrics' => [
                ['name' => 'activeUsers'],
                ['name' => 'screenPageViews'],
            ],
            'limit' => $days,
        ];

        $cacheKey = "ga:daily:{$property}:{$days}:{$aggregate}";

        $cached = Cache::get($cacheKey);
        if ($cached !== null) {
            return $cached;
        }

        try {
            $request = new RunReportRequest($body);
            $response = $this->analytics->properties->runReport($property, $request);
        } catch (\Exception $e) {
            $this->lastError = $e->getMessage();
            Log::warning('GA4 daily report failed', [
                'property' => $property,
                'days' => $days,
                'aggregate' => $aggregate,
                'error' => $e->getMessage(),
            ]);
            return ['labels' => [], 'visitors' => [], 'pageViews' => []];
        }

        $rows = $this->rowsFromResponse($response);

            // Build raw per-day series first
            $raw = [];
            foreach ($rows as $row) {
                $date = $this->dimensionValue($row, 0); // expects YYYYMMDD
                if (!$date) continue;

                try {
                    $dt = \DateTime::createFromFormat('Ymd', $date);
                    if (! $dt) continue;
                    $dayKey = $dt->format('Y-m-d');
                } catch (\Exception $e) {
                    continue;
                }

                $a = $this->metricValue($row, 0);
                $p = $this->metricValue($row, 1);

                $raw[$dayKey] = ['visitors' => $a, 'pageViews' => $p];
            }

            // Decide aggregation
            $labels = [];
            $visitors = [];
            $pageViews = [];

            if ($aggregate === 'day') {
                $startDate = new \DateTime((new \DateTime())->modify("-{$days} days")->format('Y-m-d'));
                $endDate = new \DateTime();
                $interval = new \DateInterval('P1D');
                for ($dt = clone $startDate; $dt <= $endDate; $dt->add($interval)) {
                    $k = $dt->format('Y-m-d');
                    $labels[] = $dt->format('d M');
                    $visitors[] = $raw[$k]['visitors'] ?? 0;
                    $pageViews[] = $raw[$k]['pageViews'] ?? 0;
                }
            } else {
                $buckets = [];
                foreach ($raw as $day => $vals) {
                    $dt = new \DateTime($day);
                    if ($aggregate === 'month') {
                        $key = $dt->format('Y-m');
                        $label = $dt->format('M Y');
                    } elseif ($aggregate === 'year') {
                        $key = $dt->format('Y');
                        $label = $dt->format('Y');
                    } else {
                        $key = $dt->format('Y-m-d');
                        $label = $dt->format('d M');
                    }

                    if (!isset($buckets[$key])) {
                        $buckets[$key] = ['label' => $label, 'visitors' => 0, 'pageViews' => 0, 'date' => $dt];
                    }

                    $buckets[$key]['visitors'] += $vals['visitors'];
                    $buckets[$key]['pageViews'] += $vals['pageViews'];
                }

                uasort($buckets, function($a, $b) { return $a['date'] <=> $b['date']; });

                foreach ($buckets as $bucket) {
                    $labels[] = $bucket['label'];
                    $visitors[] = $bucket['visitors'];
                    $pageViews[] = $bucket['pageViews'];
                }
            }

        $result = ['labels' => $labels, 'visitors' => $visitors, 'pageViews' => $pageViews];
        Cache::put($cacheKey, $result, 600);

        return $result;

    }

    /**
     * Return top pages by page views for the given range.
     *
     * @return array[list of ['path' => string, 'views' => int]]
     */
    public function getTopPages(int $days = 7, int $limit = 10): array
    {
        $property = $this->propertyPath();
        if (!$property) {
            return [];
        }

        $start = $days . 'daysAgo';

        $body = [
            'dateRanges' => [
                ['startDate' => $start, 'endDate' => 'today'],
            ],
            'dimensions' => [['name' => 'pagePath']],
            'metrics' => [['name' => 'screenPageViews']],
            'orderBys' => [[
                'metric' => ['metricName' => 'screenPageViews'],
                'desc' => true,
            ]],
            'limit' => $limit,
        ];

        $cacheKey = "ga:toppages:{$property}:{$days}:{$limit}";

        $cached = Cache::get($cacheKey);
        if ($cached !== null) {
            return $cached;
        }

        try {
            $request = new RunReportRequest($body);
            $response = $this->analytics->properties->runReport($property, $request);
        } catch (\Exception $e) {
            $this->lastError = $e->getMessage();
            Log::warning('GA4 top pages report failed', [
                'property' => $property,
                'days' => $days,
                'limit' => $limit,
                'error' => $e->getMessage(),
            ]);
            return [];
        }

        $out = [];
        foreach ($this->rowsFromResponse($response) as $row) {
            $path = $this->dimensionValue($row, 0) ?? '/';
            $views = $this->metricValue($row, 0);
            $out[] = ['path' => $path, 'views' => $views];
        }

        Cache::put($cacheKey, $out, 600);

        return $out;
    }

    public function getActiveUsers(int $days = 1): int
    {
        $start = $days . 'daysAgo';
        $response = $this->runReport(['activeUsers'], $start, 'today');

        $active = 0;
        foreach ($this->rowsFromResponse($response) as $row) {
            $active += $this->metricValue($row, 0);
        }

        return $active;
    }

    public function getNewUsers(int $days = 7): int
    {
        $property = $this->propertyPath();
        if (!$property) {
            return 0;
        }

        $cacheKey = "ga:newusers:{$property}:{$days}";

        $cached = Cache::get($cacheKey);
        if ($cached !== null) {
            return $cached;
        }

        $start = $days . 'daysAgo';
        $response = $this->runReport(['newUsers'], $start, 'today');
        if (!$response) {
            return 0;
        }

        $newUsers = 0;
        foreach ($this->rowsFromResponse($response) as $row) {
            $newUsers += $this->metricValue($row, 0);
        }

        Cache::put($cacheKey, $newUsers, 600);

        return $newUsers;
    }
}
