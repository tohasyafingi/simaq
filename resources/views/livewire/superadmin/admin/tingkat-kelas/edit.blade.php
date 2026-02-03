<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="update({{$tingkat_id}})" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">

                        <!-- Tingkat -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Tingkat Kelas <span class="text-danger">*</span></label>
                                <input wire:model="tingkat" type="text" class="form-control"
                                    placeholder="Masukkan tingkat (contoh: 10)">
                                <x-form-error field="tingkat" />
                            </div>
                        </div>

                        <!-- Urutan -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Urutan <span class="text-danger">*</span></label>
                                <input wire:model="urutan" type="number" class="form-control"
                                    placeholder="Masukkan urutan">
                                <x-form-error field="urutan" />
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
                    <button type="submit" class="btn btn-warning btn-md">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
