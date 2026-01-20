<div>

    <!-- ===== Hero Section Start ===== -->
    <section class="hero-section">
        <div class="hero-content text-center">
            <h3>Selamat Datang di</h3>
            <!-- <h1 id="typing-text"></h1> -->
            <h1>MA takhassus Al-Qur'an Wonosobo</h1>
            <p>Building Leaders, Inspiring Minds, Creating Tomorrow</p>
            <a href="#about" class="btn btn-primary">Learn More</a>
        </div>
    </section>
    <!-- ===== Hero Section End ===== -->

    <!-- ===== About Section Start ===== -->
    <section id="about" class="section bg-light">
        <div class="container">
            @forelse($tentang as $about)
            <h2 class="section-title mb-4">{{ $about->judul }}</h2>
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="content-text">
                        {!! $about->content !!}
                    </div>
                </div>
                @if($about->image)
                <div class="col-lg-6">
                    <img src="{{ asset('storage/'.$about->image) }}"
                        alt="{{ $about->judul }}"
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
    <!-- ===== About Section End ===== -->

    <!-- ===== Latest News Section Start ===== -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Berita Terbaru</h2>
            @forelse($beritas->chunk(3) as $chunk)
            <div class="row mb-5">
                @forelse($chunk as $berita)
                <div class="col-lg-4 mb-4">
                    <div class="card position-relative">
                        <img src="{{ $berita->thumbnail_url ?? asset('assets/berita.webp') }}" class="card-img-top"
                            alt="{{ $berita->judul }}" loading="lazy">

                        <!-- Label Kategori -->
                        <span class="badge-category">
                            {{ $berita->kategori->nama ?? 'Umum' }}
                        </span>

                        <div class="card-body">
                            <h5 class="card-title">{{ $berita->judul }}</h5>
                            <p class="card-text text-muted">
                                <small><i class="fas fa-calendar"></i>
                                    {{ $berita->created_at->format('d/m/Y') }}</small>
                            </p>
                            <p class="card-text">
                                {!! \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120, '...') !!}
                            </p>
                            <a wire:navigate href="{{ route('detail-berita-agenda', ['slug' => $berita->slug]) }}"
                                class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @empty
            <p class="text-center">Belum ada berita publik tersedia.</p>
            @endforelse
        </div>
    </section>
    <!-- ===== Latest News Section End ===== -->

    <!-- ===== Latest Karya Section Start ===== -->
    <section class="section bg-light">
        <div class="container">
            <h2 class="section-title">Karya Ilmiah Terbaru</h2>
            @forelse($karya_ilmiahs->chunk(3) as $chunk)
            <div class="row mb-5">
                @foreach($chunk as $karya_ilmiah)
                <div class="col-lg-4 mb-4">
                    <div class="card position-relative">
                        <img src="{{ $karya_ilmiah->thumbnail_url ?? asset('assets/karya.webp') }}"
                            class="card-img-top" alt="{{ $karya_ilmiah->judul }}" loading="lazy">
                        <span class="badge-category">{{ $karya_ilmiah->kategori->nama ?? 'Umum' }}</span>
                        <div class="card-body">
                            <h5 class="card-title">{{ $karya_ilmiah->judul }}</h5>
                            <p class="card-text text-muted"><small><i class="fas fa-calendar"></i>
                                    {{ $karya_ilmiah->created_at->format('d/m/Y') }}</small></p>
                            <p class="card-text">
                                {!! \Illuminate\Support\Str::limit(strip_tags($karya_ilmiah->isi), 120, '...') !!}
                            </p>
                            <a wire:navigate href="{{ route('detail-karya-ilmiah', ['slug' => $karya_ilmiah->slug]) }}"
                                class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @empty
            <p class="text-center">Belum ada karya ilmiah publik tersedia.</p>
            @endforelse
        </div>
    </section>
    <!-- ===== Latest News Section End ===== -->

    <!-- ===== Gallery Section Start ===== -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Gallery</h2>
            <div class="gallery-grid row g-3">
                @foreach($galleries as $gallery)
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="gallery-item position-relative cursor-pointer"
                            wire:click="selectGallery({{ $gallery->id }})">
                            <img src="{{ asset('storage/'.$gallery->thumbnail) }}"
                                alt="{{ $gallery->judul }}" class="img-fluid rounded">
                            <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-white text-center bg-dark bg-opacity-50 opacity-0 hover-opacity-100 transition">
                                <h5>{{ $gallery->judul }}</h5>
                                <p class="mb-0">{{ $gallery->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- ===== Slider Modal ===== -->
            <div class="modal fade" id="gallerySliderModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content bg-transparent border-0">
                        <div class="modal-body p-0">
                            @if($galleryImages)
                            <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($galleryImages as $key => $img)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/'.$img) }}" class="d-block w-100 rounded" alt="Gallery Image">
                                    </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a wire:navigate href="{{route('galeri')}}" class="btn btn-primary">View All Gallery</a>
            </div>
        </div>
    </section>
    <!-- ===== Gallery Section End ===== -->

    <!-- ===== Admission Section Start ===== -->
    <section class="section bg-light">
        <div class="container">
            @forelse($ppdb as $activity)
            <h2 class="section-title">{{ $activity->judul }}</h2>
            <div class="row align-items-center">
                @if($activity->image)
                <div class="col-lg-6">
                    <img src="{{ asset('storage/'.$activity->image) }}"
                        alt="{{ $activity->judul }}"
                        class="img-fluid rounded mb-3 mb-lg-0" />
                </div>
                @endif
                <div class="col-lg-6">
                    <div class="content-text">
                        {!! $activity->content !!}
                    </div>
                    @if($activity->link)
                    <a href="{{ $activity->link }}" target="_blank" class="btn btn-primary mt-3">
                        Register Now
                    </a>
                    @endif
                </div>
                @empty
                <div class="alert alert-warning text-center">
                    Konten PPDB belum tersedia.
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- ===== Admission Section End ===== -->

    <!-- ===== Contact Section Start ===== -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Get In Touch</h2>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5>
                        <i class="fas fa-map-marker-alt text-primary"></i>
                        Address
                    </h5>
                    <p>
                        123 Education Street<br />City, State 12345<br />Country
                    </p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5><i class="fas fa-phone text-primary"></i> Phone</h5>
                    <p>+1 (555) 123-4567<br />+1 (555) 987-6543</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5>
                        <i class="fas fa-envelope text-primary"></i> Email
                    </h5>
                    <p>
                        <a href="mailto:info@smaschool.edu"
                            style="color: inherit; text-decoration: none">info@smaschool.edu</a><br /><a
                            href="mailto:admissions@smaschool.edu"
                            style="color: inherit; text-decoration: none">admissions@smaschool.edu</a>
                    </p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-8 mx-auto">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.5317778782146!2d109.88533677596475!3d-7.406240572933534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7aa162f26a900f%3A0x4415158fe6f9b809!2sMA%20Takhassus%20Al-Qur&#39;an!5e0!3m2!1sen!2sid!4v1762429192769!5m2!1sen!2sid"
                        width="100%" height="500" style="border: 0; border-radius: 8px" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

    <style>
        .card {
            position: relative;
        }

        .badge-category {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #1abc9c;
            color: white;
            padding: 5px 10px;
            font-size: 0.8rem;
            border-radius: 3px;
            font-weight: bold;
            z-index: 10;
        }

        .gallery-item {
            overflow: hidden;
        }

        .gallery-item img {
            transition: transform 0.5s;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            transition: opacity 0.3s;
        }

        .hover-opacity-100:hover {
            opacity: 1 !important;
        }

        #gallerySliderModal .carousel-item img {
            max-width: 100vw;
            max-height: 80vh;
            object-fit: contain;
            margin: 0 auto;
        }
    </style>
    @script
    <script>
        (function() {
            function showModalAndInitCarousel() {
                const modalEl = document.getElementById('gallerySliderModal');
                if (!modalEl) return;
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
            }

            // Register immediately if $wire is present
            try {
                if (typeof $wire !== 'undefined' && $wire.on) {
                    $wire.on('openGalleryModal', () => {
                        console.debug('Livewire event received: openGalleryModal');
                        showModalAndInitCarousel();
                    });
                    $wire.on('hideGalleryModal', () => {
                        console.debug('Livewire event received: hideGalleryModal');
                        hideModalCleanup();
                    });
                }
            } catch (e) {
                // ignore
            }

            // Also listen after livewire load to be safe
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

            // Fallback: listen for plain window events
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

                // Hanya aktif jika modal sedang terbuka
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (!modalInstance || !modalEl.classList.contains('show')) return;

                const carouselInstance = bootstrap.Carousel.getInstance(carouselEl);
                if (!carouselInstance) return;

                if (e.key === 'ArrowRight') {
                    carouselInstance.next(); // geser ke gambar berikutnya
                } else if (e.key === 'ArrowLeft') {
                    carouselInstance.prev(); // geser ke gambar sebelumnya
                }
            });
        })();
    </script>
    @endscript

</div>