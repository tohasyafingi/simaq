<div class="container-fluid">
    <!-- Content Header -->
    <div class="app-content-header mb-4">
        <div class="row">
            <div class="col-12 col-md-6">
                <h3 class="mb-0"><i class="bi bi-person-fill sm-1"></i> {{$title}} {{ $rombel->nama }}</h3>
            </div>
            <div class="col-12 col-md-6">
                <ol class="breadcrumb float-md-end">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.admin.rombel.index') }}">Rombel</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $rombel->nama }}</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Form Tambah Siswa -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Tambah Siswa</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="addSiswa">
                <div class="row mb-3 align-items-end">
                    <!-- Pencarian Siswa -->
                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                        <label for="search_siswa" class="form-label">Cari Siswa (Nama atau NIS)</label>
                        <input wire:model.live="search" type="text" class="form-control" id="search_siswa" placeholder="Cari siswa berdasarkan nama atau NIS">
                    </div>

                    <!-- Dropdown Pilih Siswa -->
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <label for="siswa_id" class="form-label">Pilih Siswa</label>
                        <select wire:model.live="siswa_id" class="form-select" id="siswa_id">
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswaList as $siswa)
                            <option value="{{ $siswa->id }}">{{ $siswa->nis }} - {{ $siswa->name }}</option>
                            @endforeach
                        </select>
                        @error('siswa_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Tombol Tambah Siswa -->
                    <div class="col-12 col-md-4 d-flex justify-content-md-start justify-content-center">
                        <button type="submit" class="btn btn-primary w-100 w-md-auto">Tambah Siswa</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Siswa dalam Rombel -->
    <div class="card">
        <div class="card-header">
            <h5>Siswa dalam Rombel: {{ $rombel->nama }}</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="row mb-3 align-items-end">
                    <div class="col-12 col-md-2 mb-3 mb-md-0">
                        <label for="paginate" class="form-label">Tampilkan</label>
                        <select wire:model.live="paginate" id="paginate" class="form-select">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <input wire:model.live="searchSiswa" type="text" class="form-control" placeholder="Cari siswa...">
                    </div>
                </div>
            </div>

            <!-- Tabel Siswa -->
            <div class="table-responsive">
                <table class="table table-hover table-striped table-sm table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach($siswaInRombel as $index => $siswa)
                        <tr>
                            <td class="text-center">{{ $siswaInRombel->firstItem() + $index }}</td>
                            <td>{{ $siswa->nis }}</td>
                            <td>{{ $siswa->name }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ $siswa->pivot->status ? 'success' : 'danger' }}">
                                    {{ $siswa->pivot->status ? 'Aktif' : 'Non-Aktif' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <button wire:click="updateStatus({{ $siswa->id }}, {{ $siswa->pivot->status ? '0' : '1' }})"
                                        class="btn btn-sm btn-outline-warning me-2">
                                        <i class="fa fa-refresh"></i> Update Status
                                    </button>
                                    <button wire:click="deleteSiswa({{ $siswa->id }})"
                                        class="btn btn-sm btn-outline-danger">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $siswaInRombel->links() }} <!-- Paginasi untuk siswa di rombel -->
        </div>
    </div>

    @push('scripts')
    <script>
        $wire.on('closeCreateModal', () => {
            Swal.fire({
                title: "Sukses",
                text: "Data Berhasil Ditambah!",
                icon: "success"
            });
        });
        $wire.on('openDeleteModal', () => {
            const modalElement = document.getElementById('deleteModal');
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        });
        $wire.on('closeDeleteModal', () => {
            const modalElement = document.getElementById('deleteModal');
            const modal = bootstrap.Modal.getInstance(modalElement);
            if (modal) {
                modal.hide();
            }
            Swal.fire({
                title: "Sukses",
                text: "Data Berhasil Dihapus!",
                icon: "success"
            });
        });
    </script>
    @endpush

</div>
