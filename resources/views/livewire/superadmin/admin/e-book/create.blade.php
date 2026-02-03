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
                            <label class="form-label">
                                Judul <span class="text-danger">*</span>
                            </label>
                            <input wire:model.defer="judul" type="text"
                                class="form-control"
                                placeholder="Masukkan judul e-book">
                            <x-form-error field="judul" />
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Status <span class="text-danger">*</span>
                            </label>
                            <select wire:model.defer="status" class="form-select">
                                <option value="1">Tersedia</option>
                                <option value="0">Tidak Tersedia</option>
                            </select>
                            <x-form-error field="status" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea wire:model.defer="description"
                                class="form-control"
                                rows="4"
                                placeholder="Deskripsi singkat e-book"></textarea>
                            <x-form-error field="description" />
                        </div>

                        <!-- Thumbnail -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Thumbnail</label>
                            <input wire:model="newImage" type="file"
                                class="form-control"
                                accept=".webp,.jpg,.jpeg,.png,.avif,.svg,.gif,image/*">
                            @include('components.upload-loading', ['target' => 'newImage'])
                            @include('components.upload-preview', ['file' => $newImage, 'maxHeight' => '150px'])

                            <x-form-error field="newImage" />
                        </div>

                        <!-- File E-Book -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">File E-Book (PDF)</label>
                            <input wire:model="newFile" type="file"
                                class="form-control"
                                accept=".pdf,application/pdf">
                            @include('components.upload-loading', ['target' => 'newFile', 'label' => 'Mengunggah file...'])
                            @include('components.upload-preview', ['file' => $newFile])

                            <x-form-error field="newFile" />
                        </div>

                        <!-- Link -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Link / URL</label>
                            <input wire:model.defer="link" type="text"
                                class="form-control"
                                placeholder="Link download / Google Drive / Viewer">
                            <x-form-error field="link" />
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
