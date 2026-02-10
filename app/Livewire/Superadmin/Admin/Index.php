<?php

namespace App\Livewire\Superadmin\Admin;

use Livewire\Component;
use App\Models\Guru;
use App\Models\Bendahara;
use App\Models\GuruPelajaran;
use App\Models\TataUsaha;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Rombel;
use App\Models\RuangKelas;
use App\Models\TahunAjaran;
use App\Services\GoogleAnalyticsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Title;

#[Title('Dashboard Admin')]
class Index extends Component
{
    public bool $showPasswordModal = false;
    public $nama_admin;
    public $jumlah_guru;
    public $jumlah_bendahara;
    public $jumlah_tu;
    public $jumlah_siswa;
    public $tahun_ajaran;
    public $jumlah_jurusan;
    public $jumlah_rombel;
    public $jumlah_ruang_kelas;
    public $jumlah_pengajar;

    public $calendarEvents = [];
    public int $ga_visitors = 0;
    public int $ga_pageviews = 0;
    public int $ga_active_users = 0;
    public int $ga_new_users = 0;
    public array $gaChartLabels = [];
    public array $gaChartVisitors = [];
    public array $gaChartPageViews = [];
    public string $ga_range = '7days';
    public array $topPages = [];

    public function mount()
    {
        $this->nama_admin = Auth::user()->name ?? 'Admin';

        $counts = Cache::remember('admin.dashboard.counts', 300, function () {
            $aktif = TahunAjaran::where('status', true)->first();

            return [
                'jumlah_guru' => Guru::count(),
                'jumlah_bendahara' => Bendahara::count(),
                'jumlah_tu' => TataUsaha::count(),
                'jumlah_siswa' => Siswa::count(),
                'jumlah_jurusan' => Jurusan::count(),
                'jumlah_rombel' => Rombel::count(),
                'jumlah_ruang_kelas' => RuangKelas::count(),
                'jumlah_pengajar' => GuruPelajaran::count(),
                'tahun_ajaran' => $aktif
                    ? $aktif->tahun . ' ' . $aktif->semester
                    : 'Belum ada Tahun Ajaran Aktif',
            ];
        });

        $this->jumlah_guru = $counts['jumlah_guru'];
        $this->jumlah_bendahara = $counts['jumlah_bendahara'];
        $this->jumlah_tu = $counts['jumlah_tu'];
        $this->jumlah_siswa = $counts['jumlah_siswa'];
        $this->jumlah_jurusan = $counts['jumlah_jurusan'];
        $this->jumlah_rombel = $counts['jumlah_rombel'];
        $this->jumlah_ruang_kelas = $counts['jumlah_ruang_kelas'];
        $this->jumlah_pengajar = $counts['jumlah_pengajar'];
        $this->tahun_ajaran = $counts['tahun_ajaran'];

        /** =========================
         * Google Analytics Section
         * ========================= */
        try {
            $this->loadGa($this->ga_range);
        } catch (\Exception $e) {
            $this->ga_visitors = 0;
            $this->ga_pageviews = 0;
            $this->ga_active_users = 0;
            $this->gaChartLabels = [];
            $this->gaChartVisitors = [];
            $this->gaChartPageViews = [];
        }

        if (Auth::check() && optional(Auth::user())->password_changed_at === null) {
            $this->showPasswordModal = true;
        }
    }

    public function updatedGaRange($value)
    {
        try {
            $this->loadGa($value);
        } catch (\Exception $e) {
            $this->ga_visitors = 0;
            $this->ga_pageviews = 0;
            $this->ga_active_users = 0;
            $this->ga_new_users = 0;
            $this->gaChartLabels = [];
            $this->gaChartVisitors = [];
            $this->gaChartPageViews = [];
            $this->topPages = [];
        }
    }

    protected function loadGa(string $range)
    {
        $days = match ($range) {
            '7days' => 7,
            '1month' => 30,
            '6months' => 180,
            '1year' => 365,
            'all' => 3650,
            default => 7,
        };

        $aggregate = $days > 365 ? 'month' : 'day';
        if ($days > 3650) {
            $aggregate = 'year';
        }

        $cacheKey = 'admin.dashboard.ga.' . $range;
        $gaData = Cache::remember($cacheKey, 300, function () use ($days, $aggregate) {
            $ga = new GoogleAnalyticsService();

            $totals = $ga->getVisitorsAndPageViews($days);
            $daily = $ga->getDailyVisitorsAndPageViews($days, $aggregate);

            return [
                'visitors' => $totals['visitors'] ?? 0,
                'pageviews' => $totals['pageViews'] ?? 0,
                'active_users' => $ga->getActiveUsers(1),
                'new_users' => $ga->getNewUsers($days),
                'labels' => $daily['labels'] ?? [],
                'visitors_series' => $daily['visitors'] ?? [],
                'pageviews_series' => $daily['pageViews'] ?? [],
                'top_pages' => $ga->getTopPages($days, 10),
            ];
        });

        $this->ga_visitors = $gaData['visitors'];
        $this->ga_pageviews = $gaData['pageviews'];
        $this->ga_active_users = $gaData['active_users'];
        $this->ga_new_users = $gaData['new_users'];
        $this->gaChartLabels = $gaData['labels'];
        $this->gaChartVisitors = $gaData['visitors_series'];
        $this->gaChartPageViews = $gaData['pageviews_series'];
        $this->topPages = $gaData['top_pages'];
    }

    public function render()
    {
        return view('livewire.superadmin.admin.index', [
            'title' => 'Dashboard Admin'
        ]);
    }
}
