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
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between mb-1">

                            </div>
                        </div>
                        <div class="card-body">
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
                                        <label for="tahun_ajaran_id" class="form-label">Filter Tahun Ajaran</label>
                                        <select wire:model.live="tahun_ajaran_id" id="tahun_ajaran_id" class="form-select">
                                            <option value="">-- Semua Tahun Ajaran --</option>
                                            @foreach($tahunAjarans as $ta)
                                            <option value="{{ $ta->id }}">
                                                {{ $ta->tahun }} - {{ $ta->semester }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Tahun Ajaran Aktif -->
                                    <div class="col-md-3">
                                        <label class="form-label">Tahun Ajaran Aktif</label>
                                        @if ($tahunAjaranAktif)
                                        <div class="alert alert-success py-2 mb-0">
                                            <strong>{{ $tahunAjaranAktif->tahun }} - {{ $tahunAjaranAktif->semester }}</strong>
                                        </div>
                                        @else
                                        <div class="alert alert-warning py-2 mb-0">
                                            Tidak ada tahun ajaran aktif saat ini.
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Search -->
                                    <div class="col-md-3">
                                        <label for="search" class="form-label">Cari</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-search"></i>
                                            </span>
                                            <input wire:model.live="search" type="text" id="search" class="form-control"
                                                placeholder="Nama guru">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Guru</th>
                                            <th>Jumlah Pelajaran</th>
                                            <th>Jumlah Rombel</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @forelse($gurus as $index => $guru)
                                        <tr>
                                            <td class="text-center">{{ $gurus->firstItem() + $index }}</td>
                                            <td>{{ $guru->name }}</td>
                                            <td>{{ $guru->guruPelajarans->count() }}</td>
                                            <td>{{ $guru->rombels->count() }}</td>
                                            <td class="text-center">
                                                @if($guru->guruPelajarans->where('tahun_ajaran_id', $tahunAjaranAktif->id ?? 0)->count())
                                                <span class="badge {{ $guru->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $guru->status ? 'Aktif' : 'Tidak Aktif' }}
                                                </span>
                                                @else
                                                <span class="badge bg-secondary">Riwayat</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-success">
                                                    <a wire:navigate href="{{route('superadmin.admin.detail-guru-pengajar.index', $guru->id)}}" style="text-decoration: none; color: inherit;">
                                                        <i class="fas fa-eye">Detail</i>
                                                    </a>
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data guru</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{ $gurus->links() }}
                            </div>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!--end::Row-->
        </div>
    </div>
    <!--end::App Content-->
</div>