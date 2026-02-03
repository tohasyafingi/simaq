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
                    <div class="mb-3">
                        <label>Type</label>
                        <select wire:model="type" class="form-select">
                            <option value="">Pilih type</option>
                            <option value="home">Home</option>
                            <option value="tentang">About</option>
                            <option value="sejarah">Sejarah</option>
                            <option value="visi">Visi</option>
                            <option value="misi">Misi</option>
                            <option value="jurusan">Jurusan</option>
                            <option value="ekstrakurikuler">Ekstrakurikuler</option>
                            <option value="osis">Osis</option>
                            <option value="pramuka">Pramuka</option>
                            <option value="tahfidz">Tahfidz</option>
                            <option value="ppdb">Spmb</option>
                        </select>
                        <x-form-error field="type" />
                    </div>

                    <div class="mb-3">
                        <label>Judul</label>
                        <input wire:model="judul" class="form-control" />
                        <x-form-error field="judul" />
                    </div>

                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" wire:model="newImage" class="form-control" accept=".webp,.jpg,.jpeg,.png,.avif,.svg,.gif,image/*" />
                        @include('components.upload-loading', ['target' => 'newImage'])
                        @include('components.upload-preview', ['file' => $newImage, 'maxHeight' => '80px'])

                        @if($image)
                        <div class="position-relative mt-2" style="width: 150px; height: 80px;">
                            <img src="{{ asset('storage/'.$image) }}"
                                class="img-fluid rounded"
                                style="height: 80px; width: 150px; object-fit: cover;">

                            <button type="button"
                                wire:click="removeImage"
                                class="btn btn-danger btn-sm position-absolute top-0 end-0">
                                ✕
                            </button>
                        </div>
                        @endif

                        <x-form-error field="newImage" />
                    </div>

                    <div class="mb-3">
                        <label>Content</label>
                        <div wire:ignore>
                            <textarea id="editContent" wire:model.defer="content" class="form-control"></textarea>
                        </div>

                        <x-form-error field="content" />
                    </div>

                    <div class="mb-3">
                        <label>Link <small>(Pendaftaran)</small>/Sub Judul<small>(Home)</small> </label>
                        <input wire:model="link" class="form-control" />
                        <x-form-error field="link" />
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select wire:model="status" class="form-select">
                            <option value="1">Publik</option>
                            <option value="0">Draft</option>
                        </select>
                        <x-form-error field="status" />
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
