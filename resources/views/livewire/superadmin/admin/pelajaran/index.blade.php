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
                                        data-bs-target="#createModal">
                                        <i class="bi bi-plus-circle me-2"></i> Tambah
                                    </button>
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
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Tingkat</th>
                                            <th>Jurusan</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @forelse ($pelajarans as $index => $item)
                                            <tr>
                                                <td class="text-center">{{ $pelajarans->firstItem() + $index }}</td>
                                                <td>{{$item->kd_pelajaran}}</td>
                                                <td>{{$item->nama}}</td>
                                                <td>{{$item->tingkatKelas->tingkat ?? '-' }}</td>
                                                <td>{{$item->jurusan->nama ?? '-'}}</td>
                                                <td class="text-center">
                                                    @if($item->status)
                                                        <span class="badge bg-success">Aktif</span>
                                                    @else
                                                        <span class="badge bg-danger">Tidak Aktif</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <button wire:click="edit({{ $item->id }})"
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
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Data pelajaran belum tersedia.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                                {{$pelajarans->links()}}
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
    @include('livewire.superadmin.admin.pelajaran.create')
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
    @include('livewire.superadmin.admin.pelajaran.edit')
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
    @include('livewire.superadmin.admin.pelajaran.delete')
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