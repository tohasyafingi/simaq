<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Tambah {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">

                        <!-- NIS -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>NIS <span class="text-danger">*</span></label>
                                <input wire:model="nis" class="form-control" type="text" placeholder="Masukkan NIS" />
                                @error('nis') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Nama -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input wire:model="name" class="form-control" type="text"
                                    placeholder="Masukkan nama lengkap" />
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                <select wire:model="jenis_kelamin" class="form-control">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Tempat Lahir <span class="text-danger">*</span></label>
                                <input wire:model="tempat_lahir" class="form-control" type="text"
                                    placeholder="Masukkan tempat lahir" />
                                @error('tempat_lahir') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                <input wire:model="tanggal_lahir" class="form-control" type="date" />
                                @error('tanggal_lahir') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Nomor HP -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Nomor HP <span class="text-danger">*</span></label>
                                <input wire:model="no_hp" class="form-control" type="text"
                                    placeholder="Masukkan nomor HP" />
                                @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Email <span class="text-danger">*</span></label>
                                <input wire:model="email" class="form-control" type="email"
                                    placeholder="Masukkan email" />
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- KK -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>File KK</label>
                                <input wire:model="kk" class="form-control" type="file" />
                                @include('components.upload-loading', ['target' => 'kk', 'label' => 'Mengunggah file...'])
                                @include('components.upload-preview', ['file' => $kk])
                                @error('kk') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Akta -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>File Akta</label>
                                <input wire:model="akta" class="form-control" type="file" />
                                @include('components.upload-loading', ['target' => 'akta', 'label' => 'Mengunggah file...'])
                                @include('components.upload-preview', ['file' => $akta])
                                @error('akta') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Ijazah Terakhir -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>File Ijazah Terakhir</label>
                                <input wire:model="ijazah_terakhir" class="form-control" type="file" />
                                @include('components.upload-loading', ['target' => 'ijazah_terakhir', 'label' => 'Mengunggah file...'])
                                @include('components.upload-preview', ['file' => $ijazah_terakhir])
                                @error('ijazah_terakhir') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Foto Profil -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Foto Profil</label>
                                <input wire:model="img" class="form-control" type="file" />
                                @include('components.upload-loading', ['target' => 'img'])
                                @include('components.upload-preview', ['file' => $img, 'maxHeight' => '100px'])
                                @error('img') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Status <span class="text-danger">*</span></label>
                                <select wire:model="status" class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak_aktif">Tidak Aktif</option>
                                    <option value="lulus">Lulus</option>
                                </select>
                                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="col-12 col-sm-8 py-2">
                            <div class="form-group local-forms">
                                <label>Alamat <span class="text-danger">*</span></label>
                                <textarea wire:model="alamat" class="form-control"
                                    placeholder="Masukkan alamat"></textarea>
                                @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>