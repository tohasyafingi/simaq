<div>
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="fas fa-globe"></i>{{ $title }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('superadmin.admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
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
                                    <button wire:click="create" class="btn btn-md btn-primary">

                                        <i class="bi bi-plus-circle"></i> Tambah
                                    </button>

                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="mb-3 d-flex justify-content-between">
                                <div class="col-2">
                                    <select wire:model.live="selectedType" class="form-select">
                                        <option value="">Semua Tipe</option>
                                        @foreach($types as $t)
                                        <option value="{{ $t }}">{{ $t }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-search"></i>
                                        </span>
                                        <input wire:model.live="search" type="text" class="form-control"
                                            placeholder="Cari judul atau konten...">
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Judul</th>
                                            <th>Tipe</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @forelse($profiles as $index => $item)
                                        <tr>
                                            <td class="text-center">{{ ($profiles->currentPage()-1) * $profiles->perPage() + $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $item->judul }}</strong><br>
                                                <small class="text-muted">{{ Str::limit(strip_tags($item->content ?? ''), 60) }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $item->type }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if($item->image)
                                                <img src="{{ asset('storage/'.$item->image) }}" style="height:40px;" />
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($item->status)
                                                <span class="badge bg-success">Published</span>
                                                @else
                                                <span class="badge bg-secondary">Draft</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button wire:click="edit({{$item->id}})" class="btn btn-sm btn-outline-primary">

                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button wire:click="confirmDelete({{$item->id}})"
                                                        class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal" title="Hapus">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada konten.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $profiles->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
    @include('livewire.superadmin.admin.web-data.form')
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
    @include('livewire.superadmin.admin.web-data.edit')
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
    @include('livewire.superadmin.admin.web-data.delete')
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
    @script
    <script>
        let editContentValue = '';

        function initSummernote(selector, content = '') {
            if ($(selector).next('.note-editor').length) return;

            $(selector).summernote({
                height: 300,
                callbacks: {
                    onChange: function(contents) {
                        @this.set('content', contents);
                    }
                }

            });

            $(selector).summernote('code', content);
        }

        function destroySummernote(selector) {
            if ($(selector).next('.note-editor').length) {
                $(selector).summernote('destroy');
            }
        }

        // CREATE
        Livewire.on('openCreateModal', () => {
            $('#createModal').modal('show');
        });

        $('#createModal').on('shown.bs.modal', function() {
            destroySummernote('#createContent');
            initSummernote('#createContent', '');
        });

        // EDIT
        Livewire.on('openEditModal', (data) => {
            editContentValue = data.content ?? '';
            $('#editModal').modal('show');
        });

        $('#editModal').on('shown.bs.modal', function() {
            destroySummernote('#editContent');
            initSummernote('#editContent', editContentValue);
        });

        // DESTROY
        $('#createModal, #editModal').on('hidden.bs.modal', function() {
            destroySummernote('#createContent');
            destroySummernote('#editContent');
        });

        Livewire.on('resetSummernote', () => {
            destroySummernote('#createContent');
            destroySummernote('#editContent');
        });
    </script>
    @endscript


</div>