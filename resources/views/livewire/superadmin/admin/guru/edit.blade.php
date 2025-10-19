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

                        <!-- Kode Guru -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Kode Guru <span class="text-danger">*</span></label>
                                <input wire:model="kd_guru" type="text" class="form-control"
                                    placeholder="Masukkan kode guru">
                                @error('kd_guru') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Nama Guru -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Nama Guru <span class="text-danger">*</span></label>
                                <input wire:model="name" type="text" class="form-control"
                                    placeholder="Masukkan nama guru">
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Email <span class="text-danger">*</span></label>
                                <input wire:model="email" type="email" class="form-control"
                                    placeholder="Masukkan email">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- No HP -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>No HP <span class="text-danger">*</span></label>
                                <input wire:model="no_hp" type="text" class="form-control"
                                    placeholder="Masukkan nomor HP">
                                @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Foto -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Foto</label>
                                <input wire:model="img" type="file" class="form-control">
                                @error('img') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Status <span class="text-danger">*</span></label>
                                <select wire:model="status" class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
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