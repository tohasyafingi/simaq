<div>
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-book-half me-1"></i>{{ $title }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Filter & Search -->
                            <div class="mb-3">
                                <div class="row g-2 align-items-end">
                                    <!-- Paginate -->
                                    <div class="col-md-3">
                                        <label for="paginate" class="form-label">Tampilkan</label>
                                        <select wire:model.live="paginate" id="paginate" class="form-select">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>

                                    <!-- Filter Tahun Ajaran -->
                                    <div class="col-md-3">
                                        <label>Filter Tahun Ajaran</label>
                                        <select wire:model.live="tahun_ajaran_id" class="form-select">
                                            <option value="">-- Semua Tahun Ajaran --</option>
                                            @foreach($tahunAjarans as $ta)
                                            <option value="{{ $ta->id }}">{{ $ta->tahun }} - {{ $ta->semester }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Tahun Ajaran Aktif -->
                                    <div class="col-md-3">
                                        <label>Tahun Ajaran Aktif</label>
                                        @if ($tahunAjaranAktif)
                                        <div class="alert alert-success py-2 mb-0">
                                            <strong>{{ $tahunAjaranAktif->tahun }} - {{ $tahunAjaranAktif->semester }}</strong>
                                        </div>
                                        @else
                                        <div class="alert alert-warning py-2 mb-0">
                                            Tidak ada tahun ajaran aktif
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Search -->
                                    <div class="col-md-3">
                                        <label>Cari Modul</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                                            <input type="text" wire:model.live="search" class="form-control" placeholder="Cari nama modul...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm table-bordered align-middle">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 50px;">No</th>
                                            <th>Nama Modul</th>
                                            <th>Pelajaran</th>
                                            <th>Tingkat</th>
                                            <th>Jurusan</th>
                                            <th style="width: 100px;">Link</th>
                                            <th style="width: 100px;">File</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @forelse($moduls as $index => $modul)
                                        <tr>
                                            <td class="text-center">{{ $moduls->firstItem() + $index }}</td>
                                            <td>{{ $modul->nama }}</td>
                                            <td>{{ $modul->pelajaran->nama ?? '-' }}</td>
                                            <td>{{ $modul->pelajaran->tingkatKelas->tingkat ?? '-' }}</td>
                                            <td>{{ $modul->pelajaran->jurusan->nama ?? '-' }}</td>
                                            <td class="text-center">
                                                @if($modul->link)
                                                <a href="{{ $modul->link }}" target="_blank" class="btn btn-sm btn-success">
                                                    <i class="bi bi-box-arrow-up-right"></i> Buka
                                                </a>
                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($modul->file)
                                                <a href="{{ Storage::url($modul->file) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                                    <i class="fas fa-download"></i> Unduh
                                                </a>
                                                @else
                                                -
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Belum ada modul tersedia.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>

                                </table>

                                <div class="mt-3">
                                    {{ $moduls->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>