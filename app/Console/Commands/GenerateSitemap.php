<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\Berita;
use App\Models\KaryaIlmiah;
use App\Models\Downloads;
use App\Models\Books;
use App\Models\Gallery;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap.xml and write to public directory';

    public function handle()
    {
        $this->info('Generating sitemap...');

        $items = [];

        $items[] = [
            'loc' => url('/'),
            'lastmod' => Carbon::now()->toAtomString(),
            'changefreq' => 'daily',
            'priority' => '1.0',
        ];

        $static = [
            '/kontak' => 'monthly',
            '/jurusan' => 'monthly',
            '/sejarah' => 'yearly',
            '/visi-misi' => 'yearly',
            '/struktur-organisasi' => 'yearly',
            '/ekstrakurikuler' => 'monthly',
            '/osis' => 'monthly',
            '/pramuka' => 'monthly',
            '/program-tahfidz' => 'monthly',
            '/e-book' => 'monthly',
            '/download' => 'monthly',
            '/galeri' => 'monthly',
            '/berita' => 'daily',
            '/karya-ilmiah' => 'monthly',
        ];

        foreach ($static as $path => $freq) {
            $items[] = [
                'loc' => url($path),
                'changefreq' => $freq,
                'priority' => '0.8',
            ];
        }

        try {
            Berita::where('status', 1)->orderBy('updated_at', 'desc')->get(['slug', 'updated_at'])->each(function ($b) use (&$items) {
                $items[] = [
                    'loc' => url('/berita/' . $b->slug),
                    'lastmod' => optional($b->updated_at)->toAtomString() ?: Carbon::now()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.7',
                ];
            });
        } catch (\Exception $e) {
            $this->error('Berita: ' . $e->getMessage());
        }

        try {
            KaryaIlmiah::where('status', 1)->orderBy('updated_at', 'desc')->get(['slug', 'updated_at'])->each(function ($k) use (&$items) {
                $items[] = [
                    'loc' => url('/karya-ilmiah/' . $k->slug),
                    'lastmod' => optional($k->updated_at)->toAtomString() ?: Carbon::now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.6',
                ];
            });
        } catch (\Exception $e) {
            $this->error('KaryaIlmiah: ' . $e->getMessage());
        }

        try {
            Downloads::where('status', 1)->orderBy('updated_at', 'desc')->get(['id', 'updated_at'])->each(function ($d) use (&$items) {
                $items[] = [
                    'loc' => url('/download/' . $d->id),
                    'lastmod' => optional($d->updated_at)->toAtomString() ?: Carbon::now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.5',
                ];
            });
        } catch (\Exception $e) {
            $this->error('Downloads: ' . $e->getMessage());
        }

        try {
            Books::where('status', 1)->orderBy('updated_at', 'desc')->get(['id', 'updated_at'])->each(function ($b) use (&$items) {
                $items[] = [
                    'loc' => url('/e-book/' . $b->id),
                    'lastmod' => optional($b->updated_at)->toAtomString() ?: Carbon::now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.5',
                ];
            });
        } catch (\Exception $e) {
            $this->error('Books: ' . $e->getMessage());
        }

        try {
            Gallery::orderBy('updated_at', 'desc')->get(['id', 'updated_at'])->each(function ($g) use (&$items) {
                $items[] = [
                    'loc' => url('/galeri/' . $g->id),
                    'lastmod' => optional($g->updated_at)->toAtomString() ?: Carbon::now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.5',
                ];
            });
        } catch (\Exception $e) {
            $this->error('Gallery: ' . $e->getMessage());
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($items as $it) {
            $xml .= "  <url>" . PHP_EOL;
            $xml .= '    <loc>' . htmlspecialchars($it['loc'], ENT_XML1, 'UTF-8') . '</loc>' . PHP_EOL;

            if (!empty($it['lastmod'])) {
                $xml .= '    <lastmod>' . htmlspecialchars($it['lastmod'], ENT_XML1, 'UTF-8') . '</lastmod>' . PHP_EOL;
            }

            if (!empty($it['changefreq'])) {
                $xml .= '    <changefreq>' . htmlspecialchars($it['changefreq'], ENT_XML1, 'UTF-8') . '</changefreq>' . PHP_EOL;
            }

            if (!empty($it['priority'])) {
                $xml .= '    <priority>' . number_format((float) $it['priority'], 1) . '</priority>' . PHP_EOL;
            }

            $xml .= "  </url>" . PHP_EOL;
        }

        $xml .= '</urlset>' . PHP_EOL;

        $storageDir = storage_path('app/public');
        if (! file_exists($storageDir)) {
            mkdir($storageDir, 0755, true);
        }

        $storagePath = $storageDir . DIRECTORY_SEPARATOR . 'sitemap.xml';

        try {
            file_put_contents($storagePath, $xml);
            // clear cached sitemap if present
            Cache::forget('seo:sitemap.xml');
            $this->info('Sitemap written to: ' . $storagePath);
        } catch (\Exception $e) {
            $this->error('Failed to write sitemap: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
