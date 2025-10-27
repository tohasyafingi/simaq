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
                        <div class="card-header">
                            <button wire:click="create" class="btn btn-md btn-primary" data-bs-toggle="modal"
                                data-bs-target="#createModal"><i class="bi bi-person-plus-fill mr-2"></i>Tambah</button>
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
                                                placeholder="Nama rombel">
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama Rombel</th>
                                            <th>Tingkat Kelas</th>
                                            <th>Jurusan</th>
                                            <th>Ruang Kelas</th>
                                            <th>Tahun Ajaran</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach($rombels as $index => $rombel)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $rombel->nama }}</td>
                                            <td>{{ $rombel->tingkatKelas->tingkat }}</td>
                                            <td>{{ $rombel->jurusan ? $rombel->jurusan->nama : 'N/A' }}</td>
                                            <td>{{ $rombel->ruangKelas ? $rombel->ruangKelas->nama : 'N/A' }}</td>
                                            <td>{{ $rombel->tahunAjaran->tahun }} - {{ $rombel->tahunAjaran->semester }}</td>
                                            <td class="text-center">
                                                @if($rombel->tahun_ajaran_id == ($tahunAjaranAktif->id ?? null))
                                                <span class="badge {{ $rombel->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $rombel->status ? 'Aktif' : 'Tidak Aktif' }}
                                                </span>
                                                @else
                                                <span class="badge bg-secondary">Riwayat</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-success">
                                                    <a wire:navigate href="{{ route('superadmin.admin.detail-rombel.index', $rombel->id) }}" style="text-decoration: none; color: inherit;">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </button>
                                                <button wire:click="edit({{ $rombel->id }})"
                                                    class="btn btn-sm btn-outline-primary" title="Edit"
                                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button wire:click="confirmDelete({{ $rombel->id }})"
                                                    class="btn btn-sm btn-outline-danger" title="Hapus"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>

                                        </tr>
                                        @endforeach

                                        @if($rombels->isEmpty())
                                        <tr>
                                            <td colspan="8" class="text-center">Data tidak ditemukan.</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            {{ $rombels->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.superadmin.admin.rombel.create')
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
    @include('livewire.superadmin.admin.rombel.edit')
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
    @include('livewire.superadmin.admin.rombel.delete')
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