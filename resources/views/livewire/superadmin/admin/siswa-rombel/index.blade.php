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
                                        <select wire:model.live="tahun_ajaran_id" id="tahun_ajaran_id"
                                            class="form-select">
                                            <option value="">-- Semua Tahun Ajaran --</option>
                                            @foreach($tahunAjarans as $ta)
                                                <option value="{{ $ta->id }}">{{ $ta->tahun }} - {{ $ta->semester }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Tahun Ajaran Aktif -->
                                    <div class="col-md-3">
                                        <label class="form-label">Tahun Ajaran Aktif</label>
                                        @if ($tahunAjaranAktif)
                                            <div class="alert alert-success py-2 mb-0">
                                                <strong>{{ $tahunAjaranAktif->tahun }} -
                                                    {{ $tahunAjaranAktif->semester }}</strong>
                                            </div>
                                        @else
                                            <div class="alert alert-warning py-2 mb-0">Tidak ada tahun ajaran aktif saat
                                                ini.</div>
                                        @endif
                                    </div>

                                    <!-- Search -->
                                    <div class="col-md-3">
                                        <label for="search" class="form-label">Cari Siswa</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                                            <input wire:model.live="search" type="text" id="search" class="form-control"
                                                placeholder="Nama siswa">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama Siswa</th>
                                            <th>Nama Rombel</th>
                                            <th>Jumlah Pelajaran</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @forelse($siswas as $index => $siswa)
                                            <tr>
                                                <td class="text-center">{{ $siswas->firstItem() + $index }}</td>
                                                <td>{{ $siswa->name }}</td>
                                                <td>{{ $siswa->namaRombel }}</td>
                                                <td>{{ $siswa->jumlahPelajaran }}</td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge {{ $siswa->status === 'aktif' ? 'bg-success' : ($siswa->status === 'lulus' ? 'bg-primary' : 'bg-danger') }}">
                                                        {{ ucfirst($siswa->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <a wire:navigate
                                                        href="{{ route('superadmin.admin.siswa-rombel.pelajaran.index', $siswa->id) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data siswa</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{ $siswas->links() }}
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