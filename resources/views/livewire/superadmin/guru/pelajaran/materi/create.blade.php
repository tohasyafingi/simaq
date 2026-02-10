<div>
    <!-- Content Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <a wire:navigate
                        href="{{ routeRoleBased('pelajaran.materi.index', ['guruPelajaranId' => $guruPelajaranId, 'rombelId' => $rombelId]) }}"
                        class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item">
                            <a wire:navigate
                                href="{{ routeRoleBased('pelajaran.materi.index', ['guruPelajaranId' => $guruPelajaranId, 'rombelId' => $rombelId]) }}">Materi</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{$title}}</h5>
                </div>

                <div class="card-body">
                    @if($successMessage)
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ $successMessage }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <x-form-error field="general" />

                    <form wire:submit.prevent="store">
                        <div class="row g-3">
                            <!-- Judul -->
                            <div class="col-md-6">
                                <label class="form-label">Judul Materi <span class="text-danger">*</span></label>
                                <input type="text" wire:model="judul" class="form-control"
                                    placeholder="Masukkan judul materi">
                                @include('components.form-error', ['field' => 'judul'])
                            </div>

                            <!-- Tanggal -->
                            <div class="col-md-3">
                                <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" wire:model="tanggal" class="form-control">
                                @include('components.form-error', ['field' => 'tanggal'])
                            </div>

                            <!-- Jam -->
                            <div class="col-md-3">
                                <label class="form-label">Jam <span class="text-danger">*</span></label>
                                <input type="time" wire:model="jam" class="form-control">
                                @include('components.form-error', ['field' => 'jam'])
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea wire:model="deskripsi" rows="4" class="form-control"
                                    placeholder="Tuliskan deskripsi materi (opsional)"></textarea>
                                @include('components.form-error', ['field' => 'deskripsi'])
                            </div>

                            <!-- File -->
                            <!-- File Upload -->
                            <div class="col-md-6">
                                <label class="form-label">File (opsional)</label>
                                <input type="file" wire:model="file" class="form-control" accept=".pdf,application/pdf">
                                @include('components.form-error', ['field' => 'file'])

                                <!-- Preview / status upload -->
                                @include('components.upload-loading', ['target' => 'file'])
                                @include('components.upload-preview', ['file' => $file])
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select wire:model="status" class="form-select">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                @include('components.form-error', ['field' => 'status'])
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            @if($materi_id)
                                <a href="{{ routeRoleBased('pelajaran.materi.absensi', ['guruPelajaranId' => $guruPelajaranId, 'rombelId' => $rombelId, 'materiId' => $materi_id]) }}"
                                    class="btn btn-success me-2">
                                    <i class="fas fa-file-alt"></i> Absensi
                                </a>
                            @else
                                <button class="btn btn-success me-2" disabled>
                                    <i class="fas fa-file-alt"></i> Absensi
                                </button>
                            @endif
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>