<div>
    <section id="home" class="home section dark-background">
        <div class="home-background">
            @php
            $heroImage = $homeContent && $homeContent->image
            ? asset('storage/' . $homeContent->image)
            : asset('assets/landing.webp');
            @endphp
            <img
                src="{{ $heroImage }}"
                alt="{{ $homeContent->image_alt ?? 'Lingkungan MA Takhassus Al-Qur\'an Wonosobo' }}"
                class="home-bg-image"
                width="1920"
                height="1080"
                fetchpriority="high"
                decoding="async">

            <div class="overlay"></div>
        </div>

        <div class="container home-content">
            <div class="row align-items-center">

                <div class="col-lg-8">
                    <div class="home-text" data-aos="fade-right" data-aos-delay="100">

                        <span class="tagline">Selamat Datang!</span>

                        @php
                        $homeTitle = $homeContent->judul
                        ?? 'MA Takhassus Al-Qur\'an Wonosobo';
                        $homeDescription = $homeContent->link
                        ?? 'Terwujudnya Insan Madrasah yang Unggul dalam Kualitas dan Berjiwa Agamis.';
                        @endphp
                        <h1 class="home-title">
                            {{ $homeTitle }}
                        </h1>
                        <p class="home-description">
                            {{ $homeDescription }}
                        </p>

                        <div class="home-actions" data-aos="fade-right" data-aos-delay="200">
                            <a wire:navigate href="{{ route('ppdb') }}" class="btn btn-primary">SPMB</a>
                            <a href="#about" class="btn btn-outline">Learn More</a>
                        </div>

                        <div class="home-features" data-aos="fade-right" data-aos-delay="300">
                            @if($kontak?->instagram)
                            <a href="{{ $kontak->instagram }}" class="feature-item" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-instagram"></i>
                            </a>
                            @endif
                            @if($kontak?->tiktok)
                            <a href="{{ $kontak->tiktok }}" class="feature-item" aria-label="TikTok" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-tiktok"></i>
                            </a>
                            @endif
                            @if($kontak?->youtube)
                            <a href="{{ $kontak->youtube }}" class="feature-item" aria-label="YouTube" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-youtube"></i>
                            </a>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card booking-card" data-aos="fade-left" data-aos-delay="200">

                        @if ($homeContent)
                        {!! $homeContent->content !!}
                        @else
                        <p>Konten belum tersedia.</p>
                        @endif

                    </div>
                </div>

            </div>
        </div>

        @if ($beritas->isNotEmpty() || $karya_ilmiahs->isNotEmpty() || $galleries->isNotEmpty())
        <div class="event-ticker" data-aos="fade-up">
            <div class="ticker-track">
                <div class="ticker-inner">
                    @foreach ($beritas as $berita)
                    <a href="{{ route('detail-berita-agenda', $berita->slug) }}"
                        class="ticker-item">
                        <i class="bi bi-newspaper"></i> {{ $berita->judul }}
                    </a>
                    @endforeach

                    @foreach ($karya_ilmiahs->take(3) as $karya)
                    <a href="{{ route('detail-karya-ilmiah', $karya->slug) }}"
                        class="ticker-item">
                        <i class="bi bi-journal-text"></i> {{ $karya->judul }}
                    </a>
                    @endforeach

                    @foreach ($galleries->take(3) as $gallery)
                    <a href="{{ route('galeri') }}"
                        class="ticker-item">
                        <i class="bi bi-images"></i> {{ $gallery->judul }}
                    </a>
                    @endforeach

                    @foreach ($beritas as $berita)
                    <a href="{{ route('detail-berita-agenda', $berita->slug) }}"
                        class="ticker-item">
                        <i class="bi bi-newspaper"></i> {{ $berita->judul }}
                    </a>
                    @endforeach

                    @foreach ($karya_ilmiahs->take(3) as $karya)
                    <a href="{{ route('detail-karya-ilmiah', $karya->slug) }}"
                        class="ticker-item">
                        <i class="bi bi-journal-text"></i> {{ $karya->judul }}
                    </a>
                    @endforeach

                    @foreach ($galleries->take(3) as $gallery)
                    <a href="{{ route('galeri') }}"
                        class="ticker-item">
                        <i class="bi bi-images"></i> {{ $gallery->judul }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </section>

    <section class="section bg-light">
        <div class="container">

            @forelse($tentang as $activity)
            <h2 class="section-title" data-aos="fade-up">{{ $activity->judul }}</h2>
            <div class="row align-items-start justify-content-center">
                @if($activity->image)
                <div class="col-lg-6" data-aos="zoom-in">
                    <img src="{{ asset('storage/'.$activity->image) }}"
                        alt="{{ $activity->judul }}" loading="lazy"
                        class="img-fluid rounded mb-3 mb-lg-0" />
                </div>
                @endif

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="80">
                    <div class="content-text">{!! $activity->content !!}</div>
                </div>
            </div>

            @empty
            <div class="alert alert-warning text-center">
                Konten Tentang belum tersedia.
            </div>
            @endforelse

        </div>
    </section>

    <section class="section">
        <div class="container">
            @if ($beritas->isNotEmpty())
            <h2 class="section-title" data-aos="fade-up">Berita Terbaru</h2>

            @forelse ($beritas->chunk(3) as $chunk)
            <div class="row mb-5">
                @foreach ($chunk as $berita)
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card position-relative" data-aos="zoom-in">
                        <img
                            src="{{ \App\Helpers\ImageHelper::url($berita->thumbnail) ?? asset('assets/berita.webp') }}"
                            class="card-img-top"
                            alt="{{ $berita->judul }}"
                            loading="lazy">

                        <span class="badge-category">
                            {{ $berita->kategori->nama ?? 'Umum' }}
                        </span>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $berita->judul }}</h5>

                            <p class="card-text text-muted">
                                <small>
                                    <i class="fas fa-calendar"></i>
                                    {{ $berita->created_at->format('d/m/Y') }}
                                </small>
                            </p>

                            <p class="card-text">
                                {!! \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120, '...') !!}
                            </p>

                            <a
                                wire:navigate
                                href="{{ route('detail-berita-agenda', $berita->slug) }}"
                                class="btn btn-primary btn-sm mt-auto">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @empty
            <div class="alert alert-warning text-center">
                Konten berita belum tersedia.
            </div>
            @endforelse

            <div class="text-center">
                <a wire:navigate href="{{ route('berita-agenda') }}" class="btn btn-primary">
                    Lihat Berita Lainnya
                </a>
            </div>
            @endif
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            @if ($karya_ilmiahs->isNotEmpty())
            <h2 class="section-title" data-aos="fade-up">Karya Ilmiah Terbaru</h2>

            @forelse ($karya_ilmiahs->chunk(3) as $chunk)
            <div class="row mb-5">
                @foreach ($chunk as $karya)
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card position-relative" data-aos="zoom-in">
                        <img
                            src="{{ \App\Helpers\ImageHelper::url($karya->thumbnail) ?? asset('assets/karya.webp') }}"
                            class="card-img-top"
                            alt="{{ $karya->judul }}"
                            loading="lazy">

                        <span class="badge-category">
                            {{ $karya->kategori->nama ?? 'Umum' }}
                        </span>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $karya->judul }}</h5>

                            <p class="card-text text-muted">
                                <small>
                                    <i class="fas fa-calendar"></i>
                                    {{ $karya->created_at->format('d/m/Y') }}
                                </small>
                            </p>

                            <p class="card-text">
                                {!! \Illuminate\Support\Str::limit(strip_tags($karya->isi), 120, '...') !!}
                            </p>

                            <a
                                wire:navigate
                                href="{{ route('detail-karya-ilmiah', $karya->slug) }}"
                                class="btn btn-primary btn-sm mt-auto">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @empty
            <div class="alert alert-warning text-center">
                Konten karya ilmiah belum tersedia.
            </div>
            @endforelse

            <div class="text-center">
                <a wire:navigate href="{{ route('karya-ilmiah') }}" class="btn btn-primary">
                    Lihat Karya Ilmiah Lainnya
                </a>
            </div>
            @endif
        </div>
    </section>

    <section class="section">
        <div class="container">
            @if($galleries->isNotEmpty())
            <h2 class="section-title">Gallery</h2>
            <div class="gallery-grid row g-3">
                @foreach($galleries as $gallery)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="120">
                    <div class="card h-100">
                        <div class="gallery-item position-relative cursor-pointer" wire:click="selectGallery({{ $gallery->id }})">
                            <img src="{{ \App\Helpers\ImageHelper::url($gallery->thumbnail) }}"
                                alt="{{ $gallery->judul }}" loading="lazy" class="img-fluid rounded">
                            <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-white text-center bg-dark bg-opacity-50 opacity-0 hover-opacity-100 transition">
                                <h5>{{ $gallery->judul }}</h5>
                                <p class="mb-0">{{ $gallery->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @if($galleries->isEmpty())
                <div class="alert alert-warning text-center">
                    Konten gallery belum tersedia.
                </div>
                @endif
            </div>

            <div class="text-center mt-4">
                <a wire:navigate href="{{ route('galeri') }}" class="btn btn-primary">
                    Lihat Gallery Lainnya
                </a>
            </div>
            @endif
        </div>
    </section>

    <div class="modal fade" id="gallerySliderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0">

                    @if($galleryImages)
                    <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">

                        <div class="carousel-indicators">
                            @foreach($galleryImages as $key => $img)
                            <button type="button"
                                data-bs-target="#galleryCarousel"
                                data-bs-slide-to="{{ $key }}"
                                class="{{ $key == 0 ? 'active' : '' }}"
                                aria-current="{{ $key == 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $key + 1 }}">
                            </button>
                            @endforeach
                        </div>

                        <div class="carousel-inner">
                            @foreach($galleryImages as $key => $img)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ \App\Helpers\ImageHelper::url($img) }}"
                                    class="d-block w-100"
                                    alt="Gallery Image"
                                    loading="lazy">
                            </div>
                            @endforeach
                        </div>

                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $gallery->judul ?? '' }}</h5>
                            <p>{{ $gallery->deskripsi ?? '' }}</p>
                        </div>

                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#galleryCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#galleryCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>

                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <section class="section bg-light">
        <div class="container">

            @forelse($ppdb as $activity)
            <h2 class="section-title" data-aos="fade-up">{{ $activity->judul }}</h2>
            <div class="row align-items-start justify-content-center">
                @if($activity->image)
                <div class="col-lg-6" data-aos="zoom-in">
                    <img src="{{ asset('storage/'.$activity->image) }}"
                        alt="{{ $activity->judul }}" loading="lazy"
                        class="img-fluid rounded mb-3 mb-lg-0" />
                </div>
                @endif

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="80">
                    <div class="content-text">{!! $activity->content !!}</div>
                </div>
            </div>

            @if($activity->link)
            <div class="text-center mt-4">
                <a href="{{ $activity->link }}"
                    class="btn btn-primary"
                    target="_blank"
                    rel="noopener">
                    Daftar Sekarang
                </a>
            </div>
            @endif

            @empty
            <div class="alert alert-warning text-center">
                Konten PPDB belum tersedia.
            </div>
            @endforelse

        </div>
    </section>

    <section class="section" data-aos="fade-up" data-aos-duration="800">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Informasi Kontak</h2>

            @if($kontak)
            <div class="row mb-5">
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="80">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-map-marker-alt fa-2x" style="color: #1abc9c;"></i>
                            <h5 class="card-title">Alamat</h5>
                            <p class="card-text contact-text">{!! nl2br(e($kontak->alamat)) !!}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="160">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fab fa-whatsapp fa-2x" style="color: #1abc9c;"></i>
                            <h5 class="card-title">WhatsApp</h5>
                            <p class="card-text contact-text">{!! nl2br(e($kontak->telepon)) !!}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="240">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-envelope fa-2x" style="color: #1abc9c;"></i>
                            <h5 class="card-title">Email</h5>
                            <p class="card-text contact-text">
                                @if($kontak->email)
                                @foreach(explode("\n", $kontak->email) as $email)
                                <a href="mailto:{{ trim($email) }}" class="contact-link">{{ trim($email) }}</a><br>
                                @endforeach
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="section-title text-center mb-5" data-aos="fade-up">Kontak & Lokasi</h2>

            <div class="row mb-5 align-items-stretch">
                <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="120">
                    <div class="card shadow-sm h-100" style="height: 350px;">
                        <div class="card-body p-0 h-100">
                            {!! $kontak->google_map_embed ?? '<p class="text-center my-3">Peta belum tersedia</p>' !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card shadow-sm h-100" style="height: 350px;">
                        <div class="card-body">
                            <form wire:submit.prevent="sendMessage">
                                <div class="mb-2">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-sm" id="name" placeholder="Nama lengkap" required>
                                </div>

                                <div class="mb-2">
                                    <label for="email" class="form-label">Alamat Email</label>
                                    <input type="email" class="form-control form-control-sm" id="email" placeholder="email@example.com" required>
                                </div>

                                <div class="mb-2">
                                    <label for="subject" class="form-label">Subjek</label>
                                    <input type="text" class="form-control form-control-sm" id="subject" placeholder="Subjek pesan" required>
                                </div>

                                <div class="mb-2">
                                    <label for="message" class="form-label">Pesan</label>
                                    <textarea class="form-control form-control-sm" id="message" rows="3" placeholder="Pesan Anda di sini..." required></textarea>
                                </div>

                                <div class="text-center mt-2">
                                    <!-- <button type="submit" class="btn btn-primary btn-sm">Kirim Pesan</button> -->
                                    <button type="button" class="btn btn-primary btn-sm">Kirim Pesan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @else
            <div class="alert alert-warning text-center">
                Konten kontak belum tersedia.
            </div>
            @endif
        </div>
    </section>
</div>
@script
<script>
    (function() {
        function showModalAndInitCarousel() {
            const modalEl = document.getElementById('gallerySliderModal');
            if (!modalEl) return;
            try {
                disableTransformedAncestors(modalEl);
                if (window.AOS) AOS.refresh();
            } catch (e) {}
            const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modal.show();
            modalEl.addEventListener('shown.bs.modal', () => {
                const carouselEl = document.getElementById('galleryCarousel');
                if (carouselEl) {
                    try {
                        const c = bootstrap.Carousel.getInstance(carouselEl) || new bootstrap.Carousel(carouselEl, {
                            ride: false
                        });
                        c.to(0);
                    } catch (e) {}
                }
            }, {
                once: true
            });
        }

        function hideModalCleanup() {
            const modalEl = document.getElementById('gallerySliderModal');
            if (!modalEl) return;
            const modal = bootstrap.Modal.getInstance(modalEl) || bootstrap.Modal.getOrCreateInstance(modalEl);
            if (modal) modal.hide();
            document.querySelectorAll('.modal-backdrop').forEach(e => e.remove());
            document.body.classList.remove('modal-open');
            try {
                restoreTransformedAncestors();
                if (window.AOS) AOS.refresh();
            } catch (e) {}
        }
        try {
            if (typeof $wire !== 'undefined' && $wire.on) {
                $wire.on('openGalleryModal', () => {
                    console.debug('Livewire event received: openGalleryModal');
                    showModalAndInitCarousel();
                    try {
                        if (window.AOS) AOS.refresh();
                    } catch (e) {}
                });
                $wire.on('hideGalleryModal', () => {
                    console.debug('Livewire event received: hideGalleryModal');
                    hideModalCleanup();
                    try {
                        if (window.AOS) AOS.refresh();
                    } catch (e) {}
                });
            }
        } catch (e) {}

        function loadAOS(cb) {
            if (window.AOS) {
                cb();
                return;
            }
            var s = document.createElement('script');
            s.src = 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js';
            s.async = true;
            s.onload = function() {
                cb();
            };
            document.head.appendChild(s);
        }

        function initAOS() {
            try {
                if (window.AOS) {
                    AOS.init({
                        once: false,
                        disableMutationObserver: false,
                        duration: 800,
                        easing: 'ease-in-out'
                    });
                }
            } catch (e) {}
        }

        function disableTransformedAncestors(modalEl) {
            try {
                var backups = [];
                var all = document.querySelectorAll('*');
                all.forEach(function(el) {
                    if (!el || el === document.documentElement || el === document.body) return;
                    if (modalEl && (modalEl === el || modalEl.contains(el))) return;
                    var cs = window.getComputedStyle(el);
                    if (cs && cs.transform && cs.transform !== 'none') {
                        backups.push({
                            el: el,
                            transform: el.style.transform || '',
                            transition: el.style.transition || '',
                            opacity: el.style.opacity || ''
                        });
                        el.style.transform = 'none';
                        el.style.transition = 'none';
                        el.style.opacity = '1';
                    }
                });
                window._disabledTransformedAncestors = backups;
            } catch (e) {
                console.error(e);
            }
        }

        function restoreTransformedAncestors() {
            try {
                var backups = window._disabledTransformedAncestors || [];
                backups.forEach(function(b) {
                    try {
                        b.el.style.transform = b.transform;
                        b.el.style.transition = b.transition;
                        b.el.style.opacity = b.opacity;
                    } catch (e) {}
                });
                window._disabledTransformedAncestors = null;
            } catch (e) {
                console.error(e);
            }
        }

        window.addEventListener('load', function() {
            loadAOS(initAOS);
        });
        window.addEventListener('livewire:load', function() {
            loadAOS(initAOS);
        });
        document.addEventListener('livewire:update', function() {
            try {
                if (window.AOS) AOS.refresh();
            } catch (e) {}
        });

        window.addEventListener('livewire:load', function() {
            if (typeof $wire !== 'undefined' && $wire.on) {
                $wire.on('openGalleryModal', () => {
                    console.debug('Livewire (post-load) event: openGalleryModal');
                    showModalAndInitCarousel();
                });
                $wire.on('hideGalleryModal', () => {
                    console.debug('Livewire (post-load) event: hideGalleryModal');
                    hideModalCleanup();
                });
            }
        });

        window.addEventListener('openGalleryModal', function() {
            console.debug('Window event: openGalleryModal');
            showModalAndInitCarousel();
        });
        window.addEventListener('hideGalleryModal', function() {
            console.debug('Window event: hideGalleryModal');
            hideModalCleanup();
        });
        document.addEventListener('keydown', function(e) {
            const modalEl = document.getElementById('gallerySliderModal');
            const carouselEl = document.getElementById('galleryCarousel');
            if (!modalEl || !carouselEl) return;

            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (!modalInstance || !modalEl.classList.contains('show')) return;

            const carouselInstance = bootstrap.Carousel.getInstance(carouselEl);
            if (!carouselInstance) return;

            if (e.key === 'ArrowRight') {
                carouselInstance.next();
            } else if (e.key === 'ArrowLeft') {
                carouselInstance.prev();
            }
        });

    })();
</script>
@endscript