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
                                <div>
                                    <button wire:click="create" class="btn btn-md btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#createModal"><i class="bi bi-person-plus-fill mr-2"></i>
                                        Tambah</button>
                                </div>
                                <div>
                                    <button class="btn btn-md btn-success grid text-center me-0 me-sm-3 mb-3 mb-sm-0"><i
                                            class="fas fa-file-excel"></i> Import</button>
                                    <button class="btn btn-md btn-primary grid text-center me-0 me-sm-3 mb-3 mb-sm-0"><i
                                            class="fas fa-file-export"></i> Export</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="mb-3 d-flex justify-content-between">
                                <div class="col-0">
                                    <select wire:model.live="paginate" id="paginate" class="form-select ">
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
                                            placeholder="Cari dengan nama atau email">
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach ($siswa as $index => $item)
                                            <tr>
                                                <td class="text-center">{{ $siswa->firstItem() + $index }}</td>
                                                <td>{{$item->nis}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->email}}</td>
                                                <td class="text-center">
                                                    @if($item->status == 'aktif')
                                                        <span class="badge bg-success">Aktif</span>
                                                    @elseif($item->status == 'tidak_aktif')
                                                        <span class="badge bg-danger">Tidak Aktif</span>
                                                    @elseif($item->status == 'lulus')
                                                        <span class="badge bg-warning">Lulus</span>
                                                    @else
                                                        <span class="badge bg-secondary">Unknown</span>
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <button wire:click="edit({{$item->id}})"
                                                            class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                            data-bs-target="#editModal" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button wire:click="confirmDelete({{ $item->id }})"
                                                            class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal" title="Hapus">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$siswa->links()}}
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
    @include('livewire.superadmin.admin.siswa.create')
    @script
    <script>
        $wire.on('closeCreateModal', () => {
            const modalElement = document.getElementById('createModal');
            let modalInstance = bootstrap.Modal.getInstance(modalElement);

            if (!modalInstance) {
                modalInstance = new bootstrap.Modal(modalElement);
            }

            modalInstance.hide();

            Swal.fire({
                title: "Sukses",
                text: "Data Berhasil Ditambah!",
                icon: "success"
            });
        });

    </script>
    @endscript
    @include('livewire.superadmin.admin.siswa.edit')
    @script
    <script>
        $wire.on('closeEditModal', () => {
            const modalElement = document.getElementById('editModal');
            let modalInstance = bootstrap.Modal.getInstance(modalElement);

            if (!modalInstance) {
                modalInstance = new bootstrap.Modal(modalElement);
            }

            modalInstance.hide();

            Swal.fire({
                title: "Sukses",
                text: "Data Berhasil Diperbarui!",
                icon: "success"
            });
        });

    </script>
    @endscript
    @include('livewire.superadmin.admin.siswa.delete')
    @script
    <script>
        $wire.on('closeDeleteModal', () => {
            const modalElement = document.getElementById('deleteModal');
            let modalInstance = bootstrap.Modal.getInstance(modalElement);

            if (!modalInstance) {
                modalInstance = new bootstrap.Modal(modalElement);
            }

            modalInstance.hide();

            Swal.fire({
                title: "Sukses",
                text: "Data Berhasil Dihapus!",
                icon: "success"
            });
        });

    </script>
    @endscript
    <!--end::App Content-->
</div>