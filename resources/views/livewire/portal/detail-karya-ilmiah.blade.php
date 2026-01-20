<div>
    <div class="news-detail-page py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <!-- Judul dan Info -->
                    <h1 class="fw-bold mb-3 text-center">{{ $karyaIlmiah->judul }}</h1>
                    <div class="text-center text-muted mb-4 small">
                        <i class="fas fa-calendar-alt"></i> {{ $karyaIlmiah->created_at->format('d M Y') }} &nbsp; | &nbsp;
                        <i class="fas fa-user"></i> {{ $karyaIlmiah->author ?? 'Siswa' }} &nbsp; | &nbsp;
                        <i class="fas fa-tag"></i> {{ $karyaIlmiah->kategori->nama ?? 'Umum' }}
                    </div>

                    <!-- Gambar Thumbnail -->
                    <div class="news-thumbnail mb-4">
                        <img src="{{ $karyaIlmiah->thumbnail_url ?? asset('assets/karya.webp') }}"
                            alt="{{ $karyaIlmiah->judul }}" class="w-100 rounded shadow-sm news-image">
                    </div>

                    <!-- Isi KaryaIlmiah -->
                    <div class="news-content mb-4">
                        {!! $karyaIlmiah->isi !!}
                    </div>

                </div>
                <div class="col-lg-8">
                    <!-- Share Section -->
                    <div
                        class="share-section d-flex align-items-center justify-content-between border-top border-bottom py-3 my-4">
                        <span class="fw-bold text-uppercase text-secondary small">Bagikan Artikel:</span>
                        <div class="d-flex gap-2 flex-wrap justify-content-end">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                class="btn btn-sm btn-social btn-facebook" title="Bagikan ke Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($karyaIlmiah->judul) }}&url={{ urlencode(request()->fullUrl()) }}"
                                class="btn btn-sm btn-social btn-twitter" title="Bagikan ke Twitter">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($karyaIlmiah->judul . ' ' . request()->fullUrl()) }}"
                                class="btn btn-sm btn-social btn-whatsapp" target="_blank" title="Bagikan ke WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <button onclick="copyLink()" class="btn btn-sm btn-social btn-link" title="Salin tautan">
                                <i class="bi bi-link-45deg"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Author Section -->
                    <div class="author-box d-flex align-items-center border rounded p-3 bg-light">
                        <img src="{{ asset('assets/default-image.webp') }}" alt="Author" class="rounded-circle me-3"
                            style="width:60px; height:60px; object-fit:cover;">
                        <div>
                            <h6 class="mb-1">{{ $karyaIlmiah->author ?? 'Admin Sekolah' }}</h6>
                            <small class="text-muted">Official student research and innovation</small>
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

        <!-- Styling -->
        <style>
            .news-detail-page {
                background: #fafbfc;
            }

            .news-thumbnail {
                overflow: hidden;
                border-radius: 8px;
            }

            .news-image {
                width: 100%;
                height: auto;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .news-image:hover {
                transform: scale(1.02);
            }

            .news-content p {
                line-height: 1.8;
                margin-bottom: 1rem;
                font-size: 1.05rem;
                color: #333;
            }

            .news-content h2,
            .news-content h3 {
                margin-top: 2rem;
                margin-bottom: 1rem;
                font-weight: 600;
            }

            .btn-social {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 38px;
                height: 38px;
                border-radius: 50%;
                color: #fff !important;
                transition: all 0.3s;
            }

            .btn-facebook {
                background: #3b5998;
            }

            .btn-twitter {
                background: #1da1f2;
            }

            .btn-whatsapp {
                background: #25d366;
            }

            .btn-link {
                background: #6c757d;
            }

            .btn-social:hover {
                opacity: 0.8;
                transform: translateY(-2px);
            }

            .author-box {
                transition: 0.3s;
            }

            .author-box:hover {
                background: #fff;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            }
        </style>
    </div>
</div>