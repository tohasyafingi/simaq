<div>
    <div class="news-detail-page py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="fw-bold mb-3 text-center">{{ $berita->judul }}</h1>
                    <div class="text-center text-muted mb-4 small">
                        <i class="fas fa-calendar-alt"></i> {{ $berita->created_at->format('d M Y') }} &nbsp; | &nbsp;
                        <i class="fas fa-user"></i> {{ $berita->author_name ?? 'Admin' }} &nbsp; | &nbsp;
                        <i class="fas fa-tag"></i> {{ $berita->kategori->nama ?? 'Umum' }}
                    </div>
                    <div class="news-thumbnail mb-4">
                        <img src="{{ $berita->thumbnail_url ?? asset('assets/berita.webp') }}"
                            alt="{{ $berita->judul }}" class="w-100 rounded shadow-sm news-image">
                    </div>
                    <div class="news-content mb-4">
                        {!! $berita->isi !!}
                    </div>
                </div>
                <div class="col-lg-8">
                    <div
                        class="share-section d-flex align-items-center justify-content-between border-top border-bottom py-3 my-4">
                        <span class="fw-bold text-uppercase text-secondary small">Bagikan Artikel:</span>
                        <div class="d-flex gap-2 flex-wrap justify-content-end">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                class="btn btn-sm btn-social btn-facebook" title="Bagikan ke Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($berita->judul) }}&url={{ urlencode(request()->fullUrl()) }}"
                                class="btn btn-sm btn-social btn-twitter" title="Bagikan ke Twitter">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . request()->fullUrl()) }}"
                                class="btn btn-sm btn-social btn-whatsapp" target="_blank" title="Bagikan ke WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <button onclick="copyLink()" class="btn btn-sm btn-social btn-link" title="Salin tautan">
                                <i class="bi bi-link-45deg"></i>
                            </button>
                        </div>
                    </div>
                    <div class="author-box d-flex align-items-center border rounded p-3 bg-light">
                        <img src="{{ asset('assets/default-image.webp') }}" alt="Author" class="rounded-circle me-3"
                            style="width:60px; height:60px; object-fit:cover;">
                        <div>
                            <h6 class="mb-1">{{ $berita->author_name ?? 'Admin Sekolah' }}</h6>
                            <small class="text-muted">Official news and updates from our school administration</small>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script>
            function copyLink() {
                const url = window.location.href;
                navigator.clipboard?.writeText(url)
                    .then(() => alert('✅ Link berhasil disalin: ' + url))
                    .catch(() => {
                        const temp = document.createElement('input');
                        document.body.appendChild(temp);
                        temp.value = url;
                        temp.select();
                        document.execCommand('copy');
                        document.body.removeChild(temp);
                        alert('✅ Link berhasil disalin: ' + url);
                    });
            }
        </script>
    </div>
</div>