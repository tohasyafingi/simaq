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

                        <!-- NIS -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>NIS <span class="text-danger">*</span></label>
                                <input wire:model="nis" class="form-control" type="text" placeholder="Masukkan NIS" />
                                <x-form-error field="nis" />
                            </div>
                        </div>

                        <!-- Nama -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input wire:model="name" class="form-control" type="text"
                                    placeholder="Masukkan nama lengkap" />
                                <x-form-error field="name" />
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
                                <x-form-error field="jenis_kelamin" />
                            </div>
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Tempat Lahir <span class="text-danger">*</span></label>
                                <input wire:model="tempat_lahir" class="form-control" type="text"
                                    placeholder="Masukkan tempat lahir" />
                                <x-form-error field="tempat_lahir" />
                            </div>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                <input wire:model="tanggal_lahir" class="form-control" type="date" />
                                <x-form-error field="tanggal_lahir" />
                            </div>
                        </div>

                        <!-- Nomor HP -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Nomor HP <span class="text-danger">*</span></label>
                                <input wire:model="no_hp" class="form-control" type="text"
                                    placeholder="Masukkan nomor HP" />
                                <x-form-error field="no_hp" />
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Email <span class="text-danger">*</span></label>
                                <input wire:model="email" class="form-control" type="email"
                                    placeholder="Masukkan email" />
                                <x-form-error field="email" />
                            </div>
                        </div>

                        <!-- KK -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>File KK</label>
                                <input wire:model="kk" class="form-control" type="file" accept=".pdf,application/pdf" />
                                @include('components.upload-loading', ['target' => 'kk', 'label' => 'Mengunggah file...'])
                                @include('components.upload-preview', ['file' => $kk ?: $old_kk])
                                <x-form-error field="kk" />
                            </div>
                        </div>

                        <!-- Akta -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>File Akta</label>
                                <input wire:model="akta" class="form-control" type="file" accept=".pdf,application/pdf" />
                                @include('components.upload-loading', ['target' => 'akta', 'label' => 'Mengunggah file...'])
                                @include('components.upload-preview', ['file' => $akta ?: $old_akta])
                                <x-form-error field="akta" />
                            </div>
                        </div>

                        <!-- Ijazah Terakhir -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>File Ijazah Terakhir</label>
                                <input wire:model="ijazah_terakhir" class="form-control" type="file" accept=".pdf,application/pdf" />
                                @include('components.upload-loading', ['target' => 'ijazah_terakhir', 'label' => 'Mengunggah file...'])
                                @include('components.upload-preview', ['file' => $ijazah_terakhir ?: $old_ijazah_terakhir])
                                <x-form-error field="ijazah_terakhir" />
                            </div>
                        </div>


                        <!-- Foto Profil -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Foto Profil</label>
                                <input wire:model="img" class="form-control" type="file" accept=".webp,.jpg,.jpeg,.png,.avif,.svg,.gif,image/*" />
                                @include('components.upload-loading', ['target' => 'img'])
                                @include('components.upload-preview', ['file' => $img ?: $old_img, 'maxHeight' => '100px'])
                                <x-form-error field="img" />
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
                                <x-form-error field="status" />
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="col-12 col-sm-8 py-2">
                            <div class="form-group local-forms">
                                <label>Alamat <span class="text-danger">*</span></label>
                                <textarea wire:model="alamat" class="form-control"
                                    placeholder="Masukkan alamat"></textarea>
                                <x-form-error field="alamat" />
                            </div>
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