<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Tambah {{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="store" enctype="multipart/form-data">

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
                        @error('type') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Judul</label>
                        <input wire:model="judul" class="form-control" />
                        @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" wire:model="newImage" class="form-control" />
                        @include('components.upload-loading', ['target' => 'newImage'])
                        @include('components.upload-preview', ['file' => $newImage, 'maxHeight' => '80px'])
                        @if($image)
                        <div class="mt-2"><img src="{{ asset('storage/'.$image) }}" style="height:80px;" /></div>
                        @endif
                        @error('newImage') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Content</label>
                        <div wire:ignore>
                            <textarea id="createContent" class="form-control"></textarea>
                        </div>

                        @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Link <small>(Pendaftaran)</small>/Sub Judul<small>(Home)</small> </label>
                        <input wire:model="link" class="form-control" />
                        @error('link') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select wire:model="status" class="form-select">
                            <option value="1">Publik</option>
                            <option value="0">Draft</option>
                        </select>
                        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
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