<div>
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="bi bi-person-fill sm-1"></i> {{$title}}
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="#"><i class="fas fa-home"></i> Dashboard</a>
                        </li>
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
                    <!--begin::Card-->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between mb-1">
                                <a href="{{ route('superadmin.admin.karya-ilmiah.create') }}"
                                    class="btn btn-md btn-primary">
                                    <i class="bi bi-person-plus-fill me-2"></i> Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Filter dan Search -->
                            <div class="mb-3 d-flex justify-content-between">
                                <div class="col-0">
                                    <select wire:model.live="paginate" id="paginate" class="form-select">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-search"></i>
                                        </span>
                                        <input wire:model.live="search" type="text" class="form-control"
                                            placeholder="Cari berdasarkan judul">
                                    </div>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Thumbnail</th>
                                            <th>Author</th>
                                            <th>Judul</th>
                                            <th>Isi Berita</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @forelse($karya_ilmiahs as $index => $karya)
                                            <tr>
                                                <td class="text-center">{{ $karya_ilmiahs->firstItem() + $index }}</td>
                                                <td class="text-center">
                                                    <img src="{{ $karya->thumbnail_url ?? asset('images/default.jpg') }}"
                                                        class="rounded" alt="Thumbnail" width="40" height="40"
                                                        loading="lazy">
                                                </td>
                                                <td>{{ $karya->author }}</td>
                                                <td>{{ $karya->judul }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit(strip_tags($karya->isi), 50, '...') }}
                                                </td>
                                                <td class="text-center">
                                                    @if($karya->status)
                                                        <span class="badge bg-success">Aktif</span>
                                                    @else
                                                        <span class="badge bg-secondary">Draft</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <button wire:click="edit({{ $karya->id }})"
                                                            class="btn btn-sm btn-outline-primary" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button wire:click="confirmDelete({{ $karya->id }})"
                                                            class="btn btn-sm btn-outline-danger" title="Hapus">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Data tidak ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $karya_ilmiahs->links() }}
                                </div>
                            </div>
                            <!-- End Table -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</div>