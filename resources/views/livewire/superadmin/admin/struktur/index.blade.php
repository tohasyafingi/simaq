<div>
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="fas fa-users"></i>{{$title}}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('superadmin.admin.dashboard') }}"><i class="fas fa-home"></i></i> Dashboard</a></li>
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

                                <div>
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
                                            placeholder="Cari dengan nama, jabatan atau urutan">
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Urutan</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @forelse($strukturs as $index => $struktur)
                                        <tr>
                                            <td class="text-center">{{ $strukturs->firstItem() + $index }}</td>
                                            <td class="text-center">
                                                @if($struktur->user && $struktur->user->img)
                                                <img src="{{ asset('storage/' . $struktur->user->img) }}" alt="Foto {{ $struktur->user->name }}" width="40" class="rounded-circle">
                                                @else
                                                <img src="{{ asset('assets/default-image.webp') }}" alt="Default" width="40" class="rounded-circle">
                                                @endif
                                            </td>
                                            <td>{{ $struktur->user?->name ?? '-' }}</td>

                                            <td>{{ $struktur->jabatan }}</td>
                                            <td>{{ $struktur->urutan }}</td>
                                            <td>{{ $struktur->user?->name ?? '-' }}</td>
                                            <td class="text-center">
                                                @if($struktur->status)
                                                <span class="badge bg-success">Aktif</span>
                                                @else
                                                <span class="badge bg-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button wire:click="edit({{ $struktur->id }})" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit"></i></button>
                                                    <button wire:click="confirmDelete({{ $struktur->id }})" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button>
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
                                {{ $strukturs->links() }}
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

    @include('livewire.superadmin.admin.struktur.create')
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
    @include('livewire.superadmin.admin.struktur.edit')
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
    @include('livewire.superadmin.admin.struktur.delete')
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