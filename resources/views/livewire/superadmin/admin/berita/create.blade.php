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
                                    <x-form-error field="judul" />
                                </div>

                                <!-- Thumbnail, Kategori, Status -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Upload Thumbnail</label>
                                        <input type="file" class="form-control" wire:model="thumbnail" accept=".webp,.jpg,.jpeg,.png,.avif,.svg,.gif,image/*">
                                        @include('components.upload-loading', ['target' => 'thumbnail'])
                                        @include('components.upload-preview', ['file' => $thumbnail ?? $thumbnailUrl, 'maxHeight' => '100px'])
                                        <x-form-error field="thumbnail" />
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Kategori</label>
                                        <select class="form-select" wire:model.defer="kat_berita_id">
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($kategoriOptions as $kat)
                                            <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                            @endforeach
                                        </select>
                                        <x-form-error field="kat_berita_id" />
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" wire:model.defer="status">
                                            <option value="0">Privat</option>
                                            <option value="1">Publik</option>
                                        </select>
                                        <x-form-error field="status" />
                                    </div>
                                </div>

                                <!-- Isi Berita -->
                                <div class="mb-3">
                                    <label class="form-label">Isi Berita</label>
                                    <div wire:ignore>
                                        <textarea id="isi" class="form-control summernote"
                                            wire:model.defer="isi"></textarea>
                                    </div>
                                    <x-form-error field="isi" />
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
        let summernoteElement = $('.summernote');

        function initSummernote() {
            $('.tooltip').remove();

            $('.summernote').summernote({
                height: 400,
                placeholder: 'Masukkan isi berita...',
                dialogsInBody: true,
                tooltip: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                videoAttributes: {
                role: 'presentation',
                allowfullscreen: 'allowfullscreen',
                frameborder: '0',
                width: '100%',
                height: '350'
            },
                callbacks: {
                    onInit: function() {
                        $('.note-btn[data-toggle="dropdown"]').attr('data-bs-toggle', 'dropdown');

                        let content = @js($isi);
                        if (content) {
                            $('.summernote').summernote('code', content);
                        }
                    },
                    onChange: function(contents) {
                        clearTimeout(window.summernoteTimeout);
                        window.summernoteTimeout = setTimeout(() => {
                            $wire.set('isi', contents);
                        }, 500);
                    }
                }
            });
        }

        $(document).ready(function() {
            initSummernote();
        });

        document.addEventListener('livewire:navigated', () => {
            initSummernote();
        });

        Livewire.hook('morph.updated', ({
            el,
            component
        }) => {
            if (!summernoteElement.hasClass('note-editor')) {
                initSummernote();
            }
        });
    </script>
    @endscript
</div>
