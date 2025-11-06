<div>
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="bi bi-newspaper me-1"></i> {{ $karya_ilmiahId ? 'Edit Karya Ilmiah' : 'Tambah Karya Ilmiah' }}
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $karya_ilmiahId ? 'Edit Karya Ilmiah' : 'Tambah Karya Ilmiah' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h5 class="mb-0">Formulir Karya Ilmiah</h5></div>
                        <div class="card-body">
                            <form wire:submit.prevent="store" enctype="multipart/form-data">
                                @csrf

                                <!-- Judul -->
                                <div class="mb-3">
                                    <label class="form-label">Judul Karya Ilmiah</label>
                                    <input type="text" class="form-control" wire:model.defer="judul" placeholder="Masukkan judul karya ilmiah">
                                    @error('judul') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Author -->
                                <div class="mb-3">
                                    <label class="form-label">Author</label>
                                    <input type="text" class="form-control" wire:model.defer="author" placeholder="Masukkan nama author">
                                    @error('author') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Thumbnail, Kategori, Status -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Upload Thumbnail</label>
                                        <input type="file" class="form-control" wire:model="thumbnail" accept="image/*">
                                        @if($thumbnail)
                                            <img src="{{ $thumbnail->temporaryUrl() }}" class="mt-2 rounded" width="100">
                                        @elseif($thumbnailUrl)
                                            <img src="{{ $thumbnailUrl }}" class="mt-2 rounded" width="100">
                                        @endif
                                        @error('thumbnail') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Kategori</label>
                                        <select class="form-select" wire:model.defer="kat_karya_ilmiah_id">
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($kategoriOptions as $kat)
                                                <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kat_karya_ilmiah_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" wire:model.defer="status">
                                            <option value="0">Draft</option>
                                            <option value="1">Publik</option>
                                        </select>
                                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Isi Karya Ilmiah -->
                                <div class="mb-3">
                                    <label class="form-label">Isi Karya Ilmiah</label>
                                    <div wire:ignore>
                                        <textarea id="isi" class="form-control summernote" wire:model.defer="isi"></textarea>
                                    </div>
                                    @error('isi') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">{{ $karya_ilmiahId ? 'Update' : 'Simpan' }}</button>
                                <a href="{{ route('superadmin.admin.karya-ilmiah.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @script
    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 300,
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('isi', contents);
                    }
                }
            });

            @if($isi)
                $('.summernote').summernote('code', {!! json_encode($isi) !!});
            @endif
        });
    </script>
    @endscript
</div>
