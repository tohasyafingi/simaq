<div>
    <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
        <div class="container text-center">
            <h1 data-aos="fade-down" data-aos-duration="800">Galeri Kegiatan</h1>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="gallery-grid row g-3">
                @foreach($galleries as $gallery)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="120">
                    <div class="card h-100 shadow-sm">

                        {{-- IMAGE --}}
                        <div class="gallery-item cursor-pointer"
                            wire:click="selectGallery({{ $gallery->id }})">
                            <img src="{{ asset('storage/'.$gallery->thumbnail) }}"
                                alt="{{ $gallery->judul }}"
                                loading="lazy"
                                class="img-fluid rounded-top">
                        </div>

                        {{-- CAPTION BELOW CARD --}}
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-1" wire:click="selectGallery({{ $gallery->id }})" style="cursor: pointer;">
                                        {{ $gallery->judul }}
                                    </h5>

                                    <p class="card-text text-muted small mb-3">
                                        {{ $gallery->deskripsi }}
                                    </p>
                                </div>
                                {{-- SHARE --}}
                                <button
                                    type="button"
                                    class="btn btn-sm btn-social btn-native"
                                    title="Bagikan galeri"
                                    aria-label="Bagikan galeri {{ $gallery->judul }}"
                                    x-on:click.stop="shareGallery('{{ str($gallery->judul)->slug() }}')">
                                    <i class="bi bi-share-fill"></i>
                                </button>
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
                            <h5>{{ $selectedGallery->judul ?? '' }}</h5>
                            <p>{{ $selectedGallery->deskripsi ?? '' }}</p>
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

    @script
    <script>
        (function() {
            // Helpers: temporarily remove transforms from elements that would break fixed positioning
            function disableTransformedAncestors(modalEl) {
                try {
                    var backups = [];
                    var all = document.querySelectorAll('*');
                    all.forEach(function(el) {
                        if (!el || el === document.documentElement || el === document.body) return;
                        if (modalEl && (modalEl === el || modalEl.contains(el))) return; // don't touch modal descendants
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
                modalEl.addEventListener('hidden.bs.modal', () => {
                    finalizeClose();
                }, { once: true });
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

            function finalizeClose() {
                document.querySelectorAll('.modal-backdrop').forEach(e => e.remove());
                document.body.classList.remove('modal-open');
                if (window.history && window.history.pushState) {
                    window.history.pushState({}, '', '/gallery');
                }
                try {
                    restoreTransformedAncestors();
                    if (window.AOS) AOS.refresh();
                } catch (e) {}
            }

            function hideModalCleanup() {
                const modalEl = document.getElementById('gallerySliderModal');
                if (!modalEl) return;
                const modal = bootstrap.Modal.getInstance(modalEl) || bootstrap.Modal.getOrCreateInstance(modalEl);
                if (modal) modal.hide();
                finalizeClose();
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
            } catch (e) {}

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
    @script
    <script>
        window.shareGallery = function(slug) {
            const url = `${window.location.origin}/gallery/${slug}`;

            if (navigator.share) {
                navigator.share({
                    title: 'Galeri Kegiatan',
                    url: url
                });
            } else {
                navigator.clipboard.writeText(url)
                    .then(() => alert('Link galeri berhasil disalin'));
            }
        }
    </script>
    @endscript

</div>