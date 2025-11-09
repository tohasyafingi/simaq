<div>
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    
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
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="card shadow-sm border-light rounded-lg">
                        <div class="card-header text-center">
                            <h3 class="mb-0">{{ $title }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3 align-items-center">
                                <!-- Foto Profil -->
                                <div class="col-md-4 text-center">
                                    <img src="{{ $userData->img ? asset('storage/' . $userData->img) : asset('assets/default-image.webp') }}"
                                        alt="Foto Profil"
                                        class="img-fluid rounded-circle border border-3 border-success shadow-sm"
                                        style="width: 270px; height: 270px; object-fit: cover;">
                                </div>

                                <!-- Data Profil -->
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        @if($role == 'guru' && isset($userData->kd_guru))
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Kode Guru</label>
                                                <input type="text" class="form-control" value="{{ $userData->kd_guru }}"
                                                    readonly>
                                            </div>
                                        @endif

                                        @if($role == 'bendahara' && isset($userData->kd_bendahara))
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Kode Bendahara</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $userData->kd_bendahara }}" readonly>
                                            </div>
                                        @endif

                                        @if($role == 'karyawan' && isset($userData->kd_tu))
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Kode Tata Usaha</label>
                                                <input type="text" class="form-control" value="{{ $userData->kd_tu }}"
                                                    readonly>
                                            </div>
                                        @endif

                                        @if(($role == 'siswa' || $role == 'alumni') && isset($userData->nis))
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Nomor Induk Siswa (NIS)</label>
                                                <input type="text" class="form-control" value="{{ $userData->nis }}"
                                                    readonly>
                                            </div>
                                        @endif

                                        <div class="col-12 mb-2">
                                            <label class="form-label">Nama</label>
                                            <input type="text" class="form-control" value="{{ $userData->name ?? '-' }}"
                                                readonly>
                                        </div>

                                        <div class="col-12 mb-2">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control"
                                                value="{{ $userData->email ?? '-' }}" readonly>
                                        </div>

                                        @if(isset($userData->no_hp))
                                            <div class="col-12 mb-2">
                                                <label class="form-label">No. HP</label>
                                                <input type="text" class="form-control" value="{{ $userData->no_hp }}"
                                                    readonly>
                                            </div>
                                        @endif

                                        @if($role == 'siswa' || $role == 'alumni')
                                            @if(isset($userData->jenis_kelamin))
                                                <div class="col-12 mb-2">
                                                    <label class="form-label">Jenis Kelamin</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $userData->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}"
                                                        readonly>
                                                </div>
                                            @endif

                                            @if(isset($userData->tempat_lahir))
                                                <div class="col-12 mb-2">
                                                    <label class="form-label">Tempat Lahir</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $userData->tempat_lahir }}" readonly>
                                                </div>

                                                <div class="col-12 mb-2">
                                                    <label class="form-label">Tanggal Lahir</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($userData->tanggal_lahir)->format('d M Y') }}"
                                                        readonly>
                                                </div>
                                            @endif

                                            @if(isset($userData->alamat))
                                                <div class="col-12 mb-2">
                                                    <label class="form-label">Alamat</label>
                                                    <textarea class="form-control" rows="2"
                                                        readonly>{{ $userData->alamat }}</textarea>
                                                </div>
                                            @endif

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Begin Change Password Form -->
                    <div class="card shadow-sm border-light rounded-lg mt-3">
                        <div class="card-body">
                            <h5>Ganti Password</h5>

                            <!-- Menampilkan pesan error jika password lama salah -->
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <!-- Menampilkan pesan sukses setelah password berhasil diubah -->
                            @if($passwordUpdated)
                                <div class="alert alert-success">
                                    Password berhasil diperbarui.
                                </div>
                            @endif

                            <form wire:submit.prevent="updatePassword">
                                <div class="row g-3">
                                    <div class="col-12 mb-2">
                                        <label class="form-label">Password Lama</label>
                                        <input type="password" wire:model="current_password" class="form-control"
                                            required>
                                        @error('current_password') <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">Password Baru</label>
                                        <input type="password" wire:model="password" class="form-control" required>
                                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">Konfirmasi Password Baru</label>
                                        <input type="password" wire:model="password_confirmation" class="form-control"
                                            required>
                                    </div>

                                    <div class="col-12 text-end mt-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-key me-1"></i> Ganti Password
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Change Password Form -->
                </div>
            </div>
        </div>
    </div>
</div>