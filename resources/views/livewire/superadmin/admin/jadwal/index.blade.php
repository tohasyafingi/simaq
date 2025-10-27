<div>
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-calendar-week"></i> {{ $title }}</h3>
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
                    <!-- Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <button class="btn btn-md btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#createModal">
                                    <i class="bi bi-plus-circle me-2"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 d-flex justify-content-between">
                                <div class="col-auto">
                                    <select wire:model.live="paginate" class="form-select">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input wire:model.live="search" type="text" class="form-control"
                                            placeholder="Cari guru atau pelajaran">
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Hari</th>
                                            <th>Jam</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Guru</th>
                                            <th>Rombel</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <tr>
                                            <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button wire:click="edit"
                                                        class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal" data-bs-target="#editModal" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button wire:click="confirmDelete"
                                                        class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal" title="Hapus">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /Card -->
                </div>
            </div>
        </div>
    </div>
</div>