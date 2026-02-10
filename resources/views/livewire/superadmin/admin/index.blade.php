<style>
    /* Custom Styles untuk kesan Premium */
    .dashboard-card {
        border: none;
        border-radius: 16px;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .icon-shape {
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gradient-blue {
        background: linear-gradient(45deg, #3b82f6, #2563eb);
    }

    .gradient-green {
        background: linear-gradient(45deg, #10b981, #059669);
    }

    .gradient-orange {
        background: linear-gradient(45deg, #f59e0b, #d97706);
    }

    .gradient-red {
        background: linear-gradient(45deg, #ef4444, #dc2626);
    }

    .gradient-indigo {
        background: linear-gradient(45deg, #6366f1, #4f46e5);
    }

    .gradient-purple {
        background: linear-gradient(45deg, #a855f7, #9333ea);
    }

    .gradient-cyan {
        background: linear-gradient(45deg, #0ea5e9, #0284c7);
    }
</style>

<div class="app-content py-4">
    <div class="container-fluid mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="text-uppercase text-muted fw-bold mb-1" style="letter-spacing: 1px; font-size: 0.75rem;">Dashboard Overview</h6>
                <h3 class="fw-bold">Selamat Datang, {{ $nama_admin }}! 👋</h3>
            </div>
            <div class="col-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 bg-light p-2 rounded-3 shadow-sm"></ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <h5 class="mb-3 fw-bold"><i class="bi bi-person-lines-fill me-2"></i>Data SDM</h5>
        <div class="row g-4 mb-5">
            @php
            $boxes = [
            ['Guru', $jumlah_guru, 'gradient-blue', 'bi-person-badge-fill'],
            ['Bendahara', $jumlah_bendahara, 'gradient-green', 'bi-wallet2'],
            ['Tata Usaha', $jumlah_tu, 'gradient-orange', 'bi-briefcase'],
            ['Siswa', $jumlah_siswa, 'gradient-red', 'bi-people-fill'],
            ];
            @endphp
            @foreach($boxes as $box)
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card dashboard-card shadow-sm {{ $box[2] }} text-white p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon-shape shadow-sm">
                            <i class="bi {{ $box[3] }} fs-3"></i>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0 opacity-75 small fw-semibold">{{ $box[0] }}</p>
                            <h4 class="mb-0 fw-bold">{{ number_format($box[1]) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row g-4">
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="mb-0 fw-bold text-dark">Statistik Pengunjung</h5>
                            <small class="text-muted">Interaksi pengguna dalam periode terpilih</small>
                        </div>
                        <select wire:model.live="ga_range" class="form-select form-select-sm w-auto border-0 bg-light shadow-none rounded-3">
                            <option value="7days">7 Hari Terakhir</option>
                            <option value="1month">1 Bulan</option>
                            <option value="6months">6 Bulan</option>
                            <option value="1year">1 Tahun</option>
                        </select>
                    </div>
                    <div style="height:350px;">
                        <canvas id="gaChart"></canvas>
                    </div>
                </div>

                <div class="row g-3">
                    @php
                    $gaBoxes = [
                    ['Aktif', $ga_active_users, 'gradient-purple', 'bi-person-check'],
                    ['Baru', $ga_new_users, 'gradient-orange', 'bi-person-plus'],
                    ['Visitor', $ga_visitors, 'gradient-cyan', 'bi-graph-up'],
                    ['Views', $ga_pageviews, 'gradient-green', 'bi-eye'],
                    ];
                    @endphp
                    @foreach($gaBoxes as $box)
                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm rounded-4 p-3 text-center">
                            <div class="text-{{ explode('-', $box[2])[1] }} mb-1">
                                <i class="bi {{ $box[3] }} fs-4"></i>
                            </div>
                            <div class="small text-muted">{{ $box[0] }}</div>
                            <div class="fw-bold fs-5">{{ number_format($box[1]) }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                    <div class="card-header bg-white border-0 py-3">
                        <h6 class="mb-0 fw-bold">Informasi Sekolah</h6>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar-event text-primary me-3 fs-5"></i>
                                <span>Tahun Ajaran</span>
                            </div>
                            <span class="badge bg-primary-soft text-primary rounded-pill">{{ $tahun_ajaran }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-building text-info me-3 fs-5"></i>
                                <span>Total Jurusan</span>
                            </div>
                            <span class="fw-bold">{{ $jumlah_jurusan }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-people text-danger me-3 fs-5"></i>
                                <span>Rombel</span>
                            </div>
                            <span class="fw-bold">{{ $jumlah_rombel }}</span>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h6 class="mb-0 fw-bold">Top 10 Halaman</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <tbody class="small">
                                    @forelse($topPages as $page)
                                    <tr>
                                        <td class="ps-3">
                                            <a href="{{ url($page['path']) }}" target="_blank" class="text-decoration-none text-dark">
                                                /{{ \Illuminate\Support\Str::limit($page['path'], 25) }}
                                            </a>
                                        </td>
                                        <td class="text-end pe-3">
                                            <span class="badge bg-light text-dark border">{{ number_format($page['views']) }}</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="text-center py-3">Tidak ada data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal-password-warning :show="$showPasswordModal" wire:click="$set('showPasswordModal', false)" />
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@script
<script>
    (function() {
        function initGaChart() {
            const ctx = document.getElementById('gaChart');
            if (!ctx) return;

            const createChart = () => {
                if (window.gaChartInstance) {
                    window.gaChartInstance.destroy();
                }

                // Custom Chart Styling
                window.gaChartInstance = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($gaChartLabels),
                        datasets: [{
                                label: 'Visitor',
                                data: @json($gaChartVisitors),
                                borderColor: '#6366f1',
                                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                                fill: true,
                                tension: 0.4,
                                borderWidth: 3,
                                pointRadius: 2
                            },
                            {
                                label: 'Page Views',
                                data: @json($gaChartPageViews),
                                borderColor: '#10b981',
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                fill: true,
                                tension: 0.4,
                                borderWidth: 3,
                                pointRadius: 2
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                align: 'end'
                            }
                        },
                        scales: {
                            y: {
                                grid: {
                                    display: false
                                },
                                beginAtZero: true
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            };

            if (typeof Chart === 'undefined') {
                const script = document.createElement('script');
                script.src = 'https://cdn.jsdelivr.net/npm/chart.js';
                script.onload = createChart;
                document.head.appendChild(script);
            } else {
                createChart();
            }
        }

        document.addEventListener('livewire:navigated', initGaChart);
        document.addEventListener('livewire:initialized', function() {
            initGaChart();
            Livewire.hook('morph.updated', (el, component) => {
                initGaChart();
            });
        });
    })();
</script>
@endscript