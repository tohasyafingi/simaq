<div>
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-person-fill sm-1"></i>{{$title}}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <!-- Filter dan Pencarian -->
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
                                        <label>Cari</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                                            <input type="text" wire:model.live="search" class="form-control" placeholder="Cari pelajaran">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Tabel Pelajaran -->
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Kode</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Rombel</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @forelse ($pelajarans as $index => $item)
                                        <tr>
                                            <td class="text-center">{{ $pelajarans->firstItem() + $index }}</td>
                                            <td>{{ $item['pelajaran']->kd_pelajaran ?? '-' }}</td>
                                            <td>{{ $item['pelajaran']->nama ?? '-' }}</td>
                                            <td>{{ $item['rombel']->nama ?? '-' }}</td>
                                            <td class="text-center">
                                                @if($item['status'])
                                                <span class="badge bg-success">Aktif</span>
                                                @else
                                                <span class="badge bg-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button class="btn btn-sm btn-outline-success">
                                                        <a wire:navigate href="{{route('superadmin.admin.guru-pengajar.materi.index', ['guruPelajaranId' => $item['guru_pelajaran_id'], 'rombelId' => $item['rombel']->id])}}" style="text-decoration: none; color: inherit;">
                                                            <i class="fas fa-eye"></i> Detail
                                                        </a>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Data pelajaran belum tersedia.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{ $pelajarans->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content-->
</div>