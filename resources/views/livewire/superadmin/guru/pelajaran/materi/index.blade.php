<div>
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="fas fa-book"></i> {{$title}}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
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
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between mb-1">
                                <!-- Tombol kiri: Tambah Materi -->
                                <div>
                                    <a wire:navigate
                                        href="{{ routeGuruOrAdmin('pelajaran.materi.create', ['guruPelajaranId' => $guruPelajaranId, 'rombelId' => $rombelId]) }}"
                                        class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tambah
                                    </a>
                                </div>

                                <!-- Tombol kanan: Rekap Absensi -->
                                <div>
                                    <a wire:navigate
                                        href="{{ routeGuruOrAdmin('pelajaran.materi.rekap', ['guruPelajaranId' => $guruPelajaranId, 'rombelId' => $rombelId]) }}"
                                        class="btn btn-success">
                                        <i class="fas fa-file-alt"></i> Rekap Absensi
                                    </a>
                                </div>
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
                                        <label>Filter Tahun Ajaran</label>
                                        <select wire:model.live="tahun_ajaran_id" class="form-select">
                                            <option value="">-- Semua Tahun Ajaran --</option>
                                            @foreach($tahunAjarans as $ta)
                                            <option value="{{ $ta->id }}">{{ $ta->tahun }} - {{ $ta->semester }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Tahun Ajaran Aktif -->
                                    <div class="col-md-3">
                                        <label>Tahun Ajaran Aktif</label>
                                        @if ($tahunAjaranAktif)
                                        <div class="alert alert-success py-2 mb-0">
                                            <strong>{{ $tahunAjaranAktif->tahun }} - {{ $tahunAjaranAktif->semester }}</strong>
                                        </div>
                                        @else
                                        <div class="alert alert-warning py-2 mb-0">
                                            Tidak ada tahun ajaran aktif
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Search -->
                                    <div class="col-md-3">
                                        <label>Cari</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                                            <input type="text" wire:model.live="search" class="form-control" placeholder="Cari materi">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Tabel Materi -->
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>File</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @forelse ($materis as $index => $materi)
                                        <tr>
                                            <td class="text-center">{{ $materis->firstItem() + $index }}</td>
                                            <td>{{ $materi->judul }}</td>
                                            <td>{{ $materi->deskripsi ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($materi->tanggal)->translatedFormat('d F Y') }}</td>
                                            <td>{{ $materi->jam }}</td>
                                            <td>
                                                @if ($materi->file)
                                                <a href="{{ asset('storage/' . $materi->file) }}" target="_blank">Lihat File</a>
                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($materi->guruPelajaran->tahun_ajaran_id == ($tahunAjaranAktif->id ?? null))
                                                <span class="badge {{ $materi->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $materi->status ? 'Aktif' : 'Tidak Aktif' }}
                                                </span>
                                                @else
                                                <span class="badge bg-secondary">Riwayat</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a wire:navigate
                                                        href="{{ routeGuruOrAdmin('pelajaran.materi.absensi', ['guruPelajaranId' => $guruPelajaranId, 'rombelId' => $rombelId, 'materiId' => $materi->id]) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        <i class="fas fa-file-alt"></i>
                                                    </a>

                                                    <a wire:navigate
                                                        href="{{ routeGuruOrAdmin('pelajaran.materi.edit', ['guruPelajaranId' => $guruPelajaranId, 'rombelId' => $rombelId, 'materiId' => $materi->id]) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <button wire:click="confirmDelete({{ $materi->id }})"
                                                        class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        title="Hapus">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Data materi belum tersedia.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>

                                </table>

                                {{ $materis->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.superadmin.guru.pelajaran.materi.delete')

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
</div>