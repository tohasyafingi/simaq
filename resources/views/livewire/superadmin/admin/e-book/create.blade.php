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

                        <!-- Judul -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Judul <span class="text-danger">*</span></label>
                                <input wire:model="title" type="text" class="form-control" placeholder="Masukkan judul">
                                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Penulis -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Penulis <span class="text-danger">*</span></label>
                                <input wire:model="author" type="text" class="form-control"
                                    placeholder="Masukkan nama penulis">
                                @error('author') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Thumbnail -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Thumbnail</label>
                                <input wire:model="thumbnail" type="file" class="form-control" accept="image/*">
                                <img src="" class="img-fluid mt-2" style="max-height:150px;">
                            </div>
                        </div>

                        <!-- File E-Book -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>File E-Book</label>
                                <input wire:model="file" type="file" class="form-control" accept=".pdf,.epub">
                                <span class="badge bg-info mt-2"></span>
                            </div>
                        </div>

                        <!-- Link -->
                        <div class="col-12 col-sm-8 py-2">
                            <div class="form-group local-forms">
                                <label>Link / URL</label>
                                <input wire:model="link" type="text" class="form-control"
                                    placeholder="Link download atau view">
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-sm-4 py-2">
                            <div class="form-group local-forms">
                                <label>Status <span class="text-danger">*</span></label>
                                <select wire:model="status" class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option value="1">Tersedia</option>
                                    <option value="0">Tidak Tersedia</option>
                                </select>
                                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
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