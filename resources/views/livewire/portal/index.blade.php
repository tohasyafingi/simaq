<div>
    <section class="hero-section">
        <div class="hero-content text-center">
            <h3>Selamat Datang di</h3>
            <h1>MA takhassus Al-Qur'an Wonosobo</h1>
            <p>Terwujudnya Insan Madrasah yang Unggul dalam Kualitas dan Berjiwa Agamis</p>
            <a href="#about" class="btn btn-primary">Learn More</a>
        </div>
    </section>

    <section id="about" class="section bg-light">
        <div class="container">
            @forelse($tentang as $about)
            <h2 class="section-title mb-4 text-center">{{ $about->judul }}</h2>

            @php
            // Izinkan <iframe> agar embed YouTube tidak hilang
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
                                                            <div class="{{ $hasImage ? 'col-lg-6' : 'col-lg-8 text-center' }} mb-4 mb-lg-0">
                                                                <div class="content-text">
                                                                    {!! $about->content !!}
                                                                </div>
                                                            </div>
                                                            @endif

                                                            {{-- Kolom gambar --}}
                                                            @if($hasImage)
                                                            <div class="{{ $hasContent ? 'col-lg-6' : 'col-lg-8 text-center' }}">
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


    <section class="section">
        <div class="container">
            <h2 class="section-title">Berita Terbaru</h2>
            @forelse($beritas->chunk(3) as $chunk)
            <div class="row mb-5">
                @foreach($chunk as $berita)
                <div class="col-lg-4 mb-4">
                    <div class="card position-relative">
                        <img src="{{ $berita->thumbnail_url ?? asset('assets/berita.webp') }}" class="card-img-top" alt="{{ $berita->judul }}" loading="lazy">
                        <span class="badge-category">{{ $berita->kategori->nama ?? 'Umum' }}</span>
                        <div class="card-body">
                            <h5 class="card-title">{{ $berita->judul }}</h5>
                            <p class="card-text text-muted"><small><i class="fas fa-calendar"></i> {{ $berita->created_at->format('d/m/Y') }}</small></p>
                            <p class="card-text">{!! \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120, '...') !!}</p>
                            <a wire:navigate href="{{ route('detail-berita-agenda', ['slug' => $berita->slug]) }}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
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
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <h2 class="section-title">Karya Ilmiah Terbaru</h2>
            @forelse($karya_ilmiahs->chunk(3) as $chunk)
            <div class="row mb-5">
                @foreach($chunk as $karya_ilmiah)
                <div class="col-lg-4 mb-4">
                    <div class="card position-relative">
                        <img src="{{ $karya_ilmiah->thumbnail_url ?? asset('assets/karya.webp') }}" class="card-img-top" alt="{{ $karya_ilmiah->judul }}" loading="lazy">
                        <span class="badge-category">{{ $karya_ilmiah->kategori->nama ?? 'Umum' }}</span>
                        <div class="card-body">
                            <h5 class="card-title">{{ $karya_ilmiah->judul }}</h5>
                            <p class="card-text text-muted"><small><i class="fas fa-calendar"></i> {{ $karya_ilmiah->created_at->format('d/m/Y') }}</small></p>
                            <p class="card-text">{!! \Illuminate\Support\Str::limit(strip_tags($karya_ilmiah->isi), 120, '...') !!}</p>
                            <a wire:navigate href="{{ route('detail-karya-ilmiah', ['slug' => $karya_ilmiah->slug]) }}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
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
        </div>
    </section>

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
                @if($galleries->isEmpty())
                <div class="alert alert-warning text-center">
                    Konten gallery belum tersedia.
                </div>
                @endif
            </div>
            <div class="text-center">
                <a wire:navigate href="{{route('galeri')}}" class="btn btn-primary">View All Gallery</a>
            </div>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            @forelse($ppdb as $activity)
            <h2 class="section-title">{{ $activity->judul }}</h2>
            <div class="row align-items-start justify-content-center">
                @if($activity->image)
                <div class="col-lg-6">
                    <img src="{{ asset('storage/'.$activity->image) }}" alt="{{ $activity->judul }}" class="img-fluid rounded mb-3 mb-lg-0" />
                </div>
                @endif
                <div class="col-lg-6">
                    <div class="content-text">{!! $activity->content !!}</div>
                    @if($activity->link)
                    <a href="{{ $activity->link }}" target="_blank" class="btn btn-primary mt-3">Register Now</a>
                    @endif
                </div>
            </div>
            @empty
            <div class="alert alert-warning text-center">Konten SPMB belum tersedia.</div>
            @endforelse
        </div>
    </section>
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

    <section class="section">
        <div class="container">
            <h2 class="section-title">Informasi Kontak</h2>

            @if($kontak)
            <div class="row mb-5">
                <div class="col-lg-4 mb-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                            <h5 class="card-title">Alamat</h5>
                            <p class="card-text">{!! nl2br(e($kontak->alamat)) !!}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                            <h5 class="card-title">Telepon</h5>
                            <p class="card-text">{!! nl2br(e($kontak->telepon)) !!}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                            <h5 class="card-title">Email</h5>
                            <p class="card-text">
                                @if($kontak->email)
                                @foreach(explode("\n", $kontak->email) as $email)
                                <a href="mailto:{{ trim($email) }}" style="color: inherit; text-decoration: none;">{{ trim($email) }}</a><br>
                                @endforeach
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="section-title text-center mb-5">Kontak & Lokasi</h2>

            <div class="row mb-5 align-items-stretch">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm h-100" style="height: 350px;">
                        <div class="card-body p-0 h-100">
                            {!! $kontak->google_map_embed ?? '<p class="text-center my-3">Peta belum tersedia</p>' !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm h-100" style="height: 350px;">
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
    <style>
        .card {
            position: relative;
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