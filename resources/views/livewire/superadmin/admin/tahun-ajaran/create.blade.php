<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Tambah {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<form wire:submit.prevent="store">
    <div class="modal-body">
        <div class="row">
            <!-- Tahun Ajaran -->
            <div class="col-12 col-sm-4 py-2">
                <div class="form-group local-forms">
                    <label>Tahun Ajaran <span class="text-danger">*</span></label>
                    <input wire:model="tahun" class="form-control" type="text"
                        placeholder="Masukkan Tahun Ajaran (contoh: 2025/2026)" />
                    <x-form-error field="tahun" />
                </div>
            </div>

            <!-- Semester -->
            <div class="col-12 col-sm-4 py-2">
                <div class="form-group local-forms">
                    <label>Semester <span class="text-danger">*</span></label>
                    <select wire:model="semester" class="form-control">
                        <option value="">Pilih Semester</option>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                    <x-form-error field="semester" />
                </div>
            </div>

            <!-- Status -->
            <div class="col-12 col-sm-4 py-2">
                <div class="form-group local-forms">
                    <label>Status <span class="text-danger">*</span></label>
                    <select wire:model="status" class="form-control">
                        <option value="">Pilih Status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <x-form-error field="status" />
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
