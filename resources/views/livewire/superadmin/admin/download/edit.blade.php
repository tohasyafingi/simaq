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
                            <input wire:model.defer="judul" type="text" class="form-control">
                            @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Status <span class="text-danger">*</span>
                            </label>
                            <select wire:model.defer="status" class="form-select">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea wire:model.defer="description"
                                class="form-control" rows="4"></textarea>
                        </div>

                        <!-- Thumbnail -->
                        <!-- Thumbnail -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Thumbnail</label>
                            <input wire:model="newImage" type="file"
                                class="form-control" accept="image/*">
                            @include('components.upload-loading', ['target' => 'newImage'])
                            @include('components.upload-preview', ['file' => $newImage, 'maxHeight' => '120px'])
                            {{-- Preview gambar lama --}}
                            @if (!$newImage && $image)
                            <img src="{{ asset('storage/'.$image) }}"
                                class="img-fluid mt-2 rounded"
                                style="max-height:150px">
                            @endif
                        </div>

                        <!-- File Download -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                File Download
                            </label>
                            <input wire:model="newFile" type="file" class="form-control">
                            @include('components.upload-loading', ['target' => 'newFile', 'label' => 'Mengunggah file...'])

                            {{-- File baru --}}
                            @include('components.upload-preview', ['file' => $newFile])

                            {{-- File lama --}}
                            @if (!$newFile && $download_id)
                            <span class="badge bg-secondary mt-2">
                                {{ basename($item->file ?? '') }}
                            </span>
                            @endif

                            @error('newFile')
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