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
                        <!-- Jam Mulai -->
                        <div class="col-12 col-sm-6 py-2">
                            <label class="form-label">Jam Mulai <span class="text-danger">*</span></label>
                            <input wire:model="jam_mulai" type="time" class="form-control">
                            @error('jam_mulai') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Jam Selesai -->
                        <div class="col-12 col-sm-6 py-2">
                            <label class="form-label">Jam Selesai <span class="text-danger">*</span></label>
                            <input wire:model="jam_selesai" type="time" class="form-control">
                            @error('jam_selesai') <small class="text-danger">{{ $message }}</small> @enderror
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