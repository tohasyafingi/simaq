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

                        <!-- Judul -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Judul <span class="text-danger">*</span>
                            </label>
                            <input wire:model.defer="judul" type="text"
                                class="form-control"
                                placeholder="Masukkan judul e-book">
                            @error('judul')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
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
                            @error('status')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea wire:model.defer="description"
                                class="form-control"
                                rows="4"
                                placeholder="Deskripsi singkat e-book"></textarea>
                            @error('description')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Thumbnail -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Thumbnail</label>
                            <input wire:model="newImage" type="file"
                                class="form-control"
                                accept="image/*">
                            @include('components.upload-loading', ['target' => 'newImage'])
                            @include('components.upload-preview', ['file' => $newImage, 'maxHeight' => '150px'])

                            @error('newImage')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- File E-Book -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">File E-Book (PDF)</label>
                            <input wire:model="newFile" type="file"
                                class="form-control"
                                accept="application/pdf">
                            @if($file)
                            <div class="mb-2 small text-muted">
                                <strong>File saat ini:</strong>
                                <a href="{{ Storage::url($file) }}" target="_blank" class="text-decoration-none">
                                    {{ basename($file) }}
                                </a>
                            </div>
                            @endif
                            @include('components.upload-loading', ['target' => 'newFile', 'label' => 'Mengunggah file...'])
                            @include('components.upload-preview', ['file' => $newFile])

                            @error('newFile')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Link -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Link / URL</label>
                            <input wire:model.defer="link" type="text"
                                class="form-control"
                                placeholder="Link download / Google Drive / Viewer">
                            @error('link')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
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