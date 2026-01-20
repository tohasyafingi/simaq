<div>
    <!-- ===== Banner Section Start ===== -->
    <section class="hero-section" style="height: 200px;">
        <div class="hero-content text-center">
            <h1>Galeri Kegiatan</h1>
        </div>
    </section>
    <!-- ===== Banner Section End ===== -->

    <!-- ===== Gallery Section ===== -->
    <section class="section">
        <div class="container">
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
        </div>
    </section>

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

    <!-- ===== Script untuk Livewire event ===== -->
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