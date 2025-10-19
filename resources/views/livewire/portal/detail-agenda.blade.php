<div>
    <!-- Page Title -->
    <div class="page-title light-background" style="padding-top: 70px">
        <div class="container">
            <nav class="breadcrumbs">
                <a href="{{ route('beranda') }}">Home</a> / <span>{{ $berita->judul }}</span>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-8 order-lg-1 order-1">
                    <div class="service-main-content">
                        <div class="service-header" data-aos="fade-up">
                            <span class="post-category">{{ $berita->kategori->nama ?? 'Uncategorized' }}</span>
                            <h1>{{ $berita->judul }}</h1>
                            <div class="service-meta">
                                <span><i class="fas fa-user"></i> {{ $berita->author_name ?? 'Admin' }}</span>
                                <span><i class="bi bi-clock"></i> {{ $berita->created_at->format('d/m/Y') }}</span>
                            </div>

                            <div class="news-thumbnail mb-4" data-aos="fade-up" data-aos-delay="100">
                                <img src="{{ $berita->thumbnail_url ?? asset('portal/assets/img/services/services-1.webp') }}"
                                    alt="{{ $berita->judul }}" class="img-fluid rounded">
                            </div>

                            <p class="content-block">
                                {!! $berita->isi !!}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 order-lg-2 order-2">
                    <div class="service-sidebar" data-aos="fade-left">

                        <div class="service-features-list" data-aos="fade-up" data-aos-delay="200">
                            <h4>Berita Terbaru</h4>
                            <ul>
                                @foreach($latestBeritas as $latest)
                                    <li>
                                        <img src="{{ $latest->thumbnail_url ?? asset('portal/assets/img/services/services-1.webp') }}"
                                            alt="{{ $latest->judul }}">
                                        <div>
                                            <a href="{{ route('detail-berita-agenda', ['slug' => $latest->slug]) }}">
                                                <h5>{{ $latest->judul }}</h5>
                                            </a>
                                            <p>{{ Str::limit(strip_tags($latest->isi), 50) }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="contact-info" data-aos="fade-up" data-aos-delay="400">
                            <h4>Bagikan</h4>
                            <div class="contact-method">
                                <!-- Twitter -->
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($berita->judul) }}&url={{ urlencode(request()->fullUrl()) }}"
                                    target="_blank" title="Share to Twitter" class="twitter">
                                    <i class="bi bi-twitter"></i>
                                </a>

                                <!-- Facebook -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                    target="_blank" title="Share to Facebook" class="facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>

                                <!-- LinkedIn -->
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($berita->judul) }}"
                                    target="_blank" title="Share to LinkedIn" class="linkedin">
                                    <i class="bi bi-linkedin"></i>
                                </a>

                                <!-- WhatsApp -->
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . request()->fullUrl()) }}"
                                    target="_blank" title="Share to WhatsApp" class="whatsapp">
                                    <i class="bi bi-whatsapp"></i>
                                </a>

                                <!-- Copy Link -->
                                <a href="javascript:void(0);" onclick="copyLink()" title="Copy Link" class="copy-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section><!-- /Service Details Section -->

    <script>
        function copyLink() {
            const url = window.location.href;

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link berhasil disalin: ' + url);
                }).catch(err => {
                    alert('Gagal menyalin link');
                });
            } else {
                // fallback untuk browser lama
                const tempInput = document.createElement('input');
                tempInput.value = url;
                document.body.appendChild(tempInput);
                tempInput.select();
                try {
                    document.execCommand('copy');
                    alert('Link berhasil disalin: ' + url);
                } catch (err) {
                    alert('Browser Anda tidak mendukung fitur ini, silakan salin link secara manual.');
                }
                document.body.removeChild(tempInput);
            }
        }
    </script>
</div>