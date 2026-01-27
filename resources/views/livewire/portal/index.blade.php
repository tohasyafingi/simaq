<div>
    <section id="home" class="home section dark-background">
        <!-- Background Video -->
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
                loading="lazy">

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

        <div id="event-ticker-anchor" class="event-ticker-anchor"></div>
        @if ($beritas->isNotEmpty())
        <div class="event-ticker" data-aos="fade-up">
            <div class="ticker-track">
                <div class="ticker-inner">
                    @foreach ($beritas as $berita)
                    <a href="{{ route('detail-berita-agenda', $berita->slug) }}"
                        class="ticker-item">
                        <i class="bi bi-newspaper"></i> {{ $berita->judul }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </section>

    <section id="about" class="section bg-light" data-aos="fade-up" data-aos-duration="800">
        <div class="container">
            @forelse($tentang as $about)
            <h2 class="section-title mb-4 text-center">{{ $about->judul }}</h2>

            @php
            $allowedTags = '<iframe>
                <p><br><a><strong><em>
                                <ul>
                                    <li>
                                        <ol><b><i>';
                                                    $hasContent = !empty(trim(strip_tags($about->content, $allowedTags)));
                                                    $hasImage = !empty($about->image);
                                                    @endphp

                                                    <div class="row align-items-start justify-content-center">
                                                        {{-- Kolom konten --}}
                                                        @if($hasContent)
                                                        <div class="{{ $hasImage ? 'col-lg-6' : 'col-lg-8 text-center' }} mb-4 mb-lg-0" data-aos="fade-right">
                                                            <div class="content-text">
                                                                {!! $about->content !!}
                                                            </div>
                                                        </div>
                                                        @endif

                                                        {{-- Kolom gambar --}}
                                                        @if($hasImage)
                                                        <div class="{{ $hasContent ? 'col-lg-6' : 'col-lg-8 text-center' }}" data-aos="fade-left">
                                                            <img src="{{ asset('storage/'.$about->image) }}"
                                                                alt="{{ $about->judul }}" loading="lazy"
                                                                class="img-fluid rounded mb-3 mb-lg-0" />
                                                        </div>
                                                        @endif
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
                            src="{{ $berita->thumbnail_url ?? asset('assets/berita.webp') }}"
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
                            src="{{ $karya->thumbnail_url ?? asset('assets/karya.webp') }}"
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
                            <img src="{{ asset('storage/'.$gallery->thumbnail) }}"
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

            <div class="text-center">
                <a wire:navigate href="{{ route('galeri') }}" class="btn btn-primary">
                    Lihat Gallery Lainnya
                </a>
            </div>
            @endif
        </div>
    </section>

    <!-- Modal Livewire dengan slider -->
    <div class="modal fade" id="gallerySliderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0">

                    @if($galleryImages)
                    <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">

                        {{-- INDICATORS --}}
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

                        {{-- SLIDES --}}
                        <div class="carousel-inner">
                            @foreach($galleryImages as $key => $img)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/'.$img) }}"
                                    class="d-block w-100"
                                    alt="Gallery Image"
                                    loading="lazy">
                            </div>
                            @endforeach
                        </div>

                        {{-- CAPTION STATIS --}}
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $gallery->judul ?? '' }}</h5>
                            <p>{{ $gallery->deskripsi ?? '' }}</p>
                        </div>

                        {{-- CONTROLS --}}
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

    <section class="section bg-light" data-aos="fade-up">
        <div class="container">
            @foreach($ppdb as $activity)
            <h2 class="section-title">{{ $activity->judul }}</h2>
            <div class="row align-items-start justify-content-center">
                @if($activity->image)
                <div class="col-lg-6" data-aos="fade-right">
                    <img src="{{ asset('storage/'.$activity->image) }}" alt="{{ $activity->judul }}" loading="lazy" class="img-fluid rounded mb-3 mb-lg-0" />
                </div>
                @endif
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="content-text">{!! $activity->content !!}</div>
                </div>

            </div>
            @if($activity->link)
            <div class="text-center">
                <a href="{{ $activity->link }}"
                    class="btn btn-primary"
                    target="_blank"
                    rel="noopener">
                    Daftar Sekarang
                </a>
            </div>
            @endif
            @endforeach
        </div>
    </section>


    <section class="section">
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

            <h2 class="section-title text-center mb-5">Kontak & Lokasi</h2>

            <div class="row mb-5 align-items-stretch">
                <div class="col-lg-6 mb-4" data-aos="fade-right">
                    <div class="card shadow-sm h-100" style="height: 350px;" data-aos="fade-in">
                        <div class="card-body p-0 h-100">
                            {!! $kontak->google_map_embed ?? '<p class="text-center my-3">Peta belum tersedia</p>' !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4" data-aos="fade-left">
                    <div class="card shadow-sm h-100" style="height: 350px;" data-aos="fade-in">
                        <div class="card-body">
                            <form wire:submit.prevent="sendMessage">
                                <div class="mb-2">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-sm" id="name" placeholder="Nama lengkap Anda" required>
                                </div>

                                <div class="mb-2">
                                    <label for="email" class="form-label">Alamat Email</label>
                                    <input type="email" class="form-control form-control-sm" id="email" placeholder="alamat.email@contoh.com" required>
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
    <!-- <style>
        .card {
            position: relative;
        }
    </style> -->
    @script
    <script>
        (function() {
            function showModalAndInitCarousel() {
                const modalEl = document.getElementById('gallerySliderModal');
                if (!modalEl) return;
                // Temporarily remove transforms that break modal fixed positioning
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
                // Restore transforms after modal is hidden
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

            // AOS integration: load library and initialize, refresh on Livewire updates
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

            // Utilities to temporarily remove transforms on page elements (except modal descendants)
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

            // Initialize AOS after load and refresh on Livewire updates
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
</div>