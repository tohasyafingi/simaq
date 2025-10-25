<div>
    <!-- Content Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <a wire:navigate href="{{ route('superadmin.admin.guru-pengajar.materi.index', ['guruPelajaranId' => $guruPelajaranId, 'rombelId' => $rombelId]) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('superadmin.admin.guru-pengajar.materi.index', ['guruPelajaranId' => $guruPelajaranId, 'rombelId' => $rombelId]) }}">Materi</a></li>
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
                    @if($errors->has('general'))
                    <div class="alert alert-danger">{{ $errors->first('general') }}</div>
                    @endif

                    <form wire:submit.prevent="store">
                        <div class="row g-3">
                            <!-- Judul -->
                            <div class="col-md-6">
                                <label class="form-label">Judul Materi <span class="text-danger">*</span></label>
                                <input type="text" wire:model="judul" class="form-control" placeholder="Masukkan judul materi">
                                @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Tanggal -->
                            <div class="col-md-3">
                                <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" wire:model="tanggal" class="form-control">
                                @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Jam -->
                            <div class="col-md-3">
                                <label class="form-label">Jam <span class="text-danger">*</span></label>
                                <input type="time" wire:model="jam" class="form-control">
                                @error('jam') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea wire:model="deskripsi" rows="4" class="form-control" placeholder="Tuliskan deskripsi materi (opsional)"></textarea>
                                @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- File -->
                            <div class="col-md-6">
                                <label class="form-label">File (opsional)</label>
                                <input type="text" wire:model="file" class="form-control" placeholder="Masukkan URL/file path">
                                @error('file') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select wire:model="status" class="form-select">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            @if($materi_id)
                            <a href="{{ route('superadmin.admin.guru-pengajar.materi.absensi', ['guruPelajaranId' => $guruPelajaranId,'rombelId' => $rombelId,'materiId' => $materi_id]) }}"
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