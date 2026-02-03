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

                        <!-- Nama Kelas -->
                        <div class="col-md-6 py-2">
                            <label class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                            <input wire:model="nama" type="text" class="form-control" placeholder="Masukkan nama kelas">
                            <x-form-error field="nama" />
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 py-2">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select wire:model="status" class="form-control">
                                <option value="">Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            <x-form-error field="status" />
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
