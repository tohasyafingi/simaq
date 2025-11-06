<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="bi bi-newspaper me-1"></i> {{ $beritaId ? 'Edit Berita' : 'Tambah Berita' }}
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $beritaId ? 'Edit Berita' : 'Tambah Berita' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Formulir Berita</h5>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="store" enctype="multipart/form-data">
                                @csrf

                                <!-- Judul -->
                                <div class="mb-3">
                                    <label class="form-label">Judul Berita</label>
                                    <input type="text" class="form-control" wire:model.defer="judul"
                                        placeholder="Masukkan judul berita">
                                    @error('judul') <span class="text-danger">{{ $message }}</span> @enderror
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
                                        <select class="form-select" wire:model.defer="kat_berita_id">
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($kategoriOptions as $kat)
                                                <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kat_berita_id') <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" wire:model.defer="status">
                                            <option value="0">Privat</option>
                                            <option value="1">Publik</option>
                                        </select>
                                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Isi Berita -->
                                <div class="mb-3">
                                    <label class="form-label">Isi Berita</label>
                                    <div wire:ignore>
                                        <textarea id="isi" class="form-control summernote"
                                            wire:model.defer="isi"></textarea>
                                    </div>
                                    @error('isi') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <button type="submit"
                                    class="btn btn-primary">{{ $beritaId ? 'Update' : 'Simpan' }}</button>
                                <a href="{{ route('superadmin.admin.berita.index') }}"
                                    class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @script
    <script type="text/javascript">
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 300,
                callbacks: {
                    onChange: function (contents, $editable) {
                        @this.set('isi', contents);
                    }
                }
            });

            // Set isi Summernote jika ada saat edit
            @if($isi)
                $('.summernote').summernote('code', {!! json_encode($isi) !!});
            @endif
    });
    </script>
    @endscript
</div>