<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1"
    aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">
                    Tambah {{ $title }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">

                        <!-- Judul -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Judul</label>
                            <input wire:model.defer="judul" type="text" class="form-control">
                            <x-form-error field="judul" />
                        </div>

                        <!-- Thumbnail -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Thumbnail</label>
                            <input wire:model="newThumbnail" type="file" class="form-control" accept=".webp,.jpg,.jpeg,.png,.avif,.svg,.gif,image/*">
                            @include('components.upload-loading', ['target' => 'newThumbnail'])
                            @include('components.upload-preview', ['file' => $newThumbnail, 'maxHeight' => '100px'])

                            <x-form-error field="newThumbnail" />
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <select wire:model.defer="status" class="form-select">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>
                        <!-- Deskripsi -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea wire:model.defer="deskripsi" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Foto Gallery -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Foto Galeri</label>
                            <input wire:model="images" type="file" class="form-control" multiple accept=".webp,.jpg,.jpeg,.png,.avif,.svg,.gif,image/*">
                            @include('components.upload-loading', ['target' => 'images', 'label' => 'Mengunggah gambar...'])

                            <div class="row mt-2">
                                @foreach($images as $index => $image)
                                <div class="col-md-2 mb-2">
                                    <div class="position-relative">
                                        @include('components.upload-preview', ['file' => $image, 'maxHeight' => '120px'])

                                        <button type="button"
                                            wire:click="removeNewImage({{ $index }})"
                                            class="btn btn-danger btn-sm position-absolute top-0 end-0">
                                            ✕
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <x-form-error field="images" />
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
