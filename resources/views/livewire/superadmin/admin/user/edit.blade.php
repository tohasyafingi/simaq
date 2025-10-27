<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="update" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <!-- Name -->
                        <div class="col-12 col-sm-6 py-2">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-12 col-sm-6 py-2">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" wire:model="email" class="form-control">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Password -->
                        <div class="col-12 col-sm-6 py-2">
                            <label>Password <span class="text-danger">*</span></label>
                            <input type="password" wire:model="password" class="form-control">
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-12 col-sm-6 py-2">
                            <label>Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" wire:model="password_confirmation" class="form-control">
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Role -->
                        <div class="col-12 col-sm-6 py-2">
                            <label>Role <span class="text-danger">*</span></label>
                            <select wire:model="role" class="form-control">
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="guru">Guru</option>
                                <option value="bendahara">Bendahara</option>
                                <option value="karyawan">Karyawan</option>
                                <option value="siswa">Siswa</option>
                            </select>
                            @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-sm-6 py-2">
                            <label>Status <span class="text-danger">*</span></label>
                            <select wire:model="status" class="form-control">
                                <option value="">Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Image -->
                        <div class="col-12 col-sm-6 py-2">
                            <label>Foto Profil</label>
                            <input type="file" wire:model="img" class="form-control">
                            @error('img') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning btn-md">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>