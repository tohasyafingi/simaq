<div>
    <Style>
        #carouselGallery .carousel-inner {
            height: 100vh;
        }

        #carouselGallery .carousel-item img {
            max-height: 100vh;
            max-width: 100%;
            object-fit: contain;
            margin: auto;
            /* untuk centering horizontal */
        }
    </Style>
    <!-- Gallery Section -->
    <section id="gallery-section" class="gallery-section section">
        <div style="padding-top: 20px">
            <div class="container section-title text-center mb-5">
                <span class="description-title">Gallery</span>
                <h2>Gallery</h2>
                <p>Kumpulan foto dan dokumentasi kegiatan kami</p>
            </div>
        </div>

        <div class="container">
            <div class="row g-4" data-aos="fade-up">

                <!-- Thumbnail (perhatikan data-gallery-index) -->
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100">
                        <a href="#" class="thumb" data-gallery-index="0">
                            <img src="{{asset('portal/assets/img/services/services-1.webp')}}" class="card-img-top"
                                alt="Gallery Image 1">
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title">Judul Foto 1</h5>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100">
                        <a href="#" class="thumb" data-gallery-index="1">
                            <img src="{{asset('portal/assets/img/services/services-2.webp')}}" class="card-img-top"
                                alt="Gallery Image 2">
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title">Judul Foto 2</h5>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100">
                        <a href="#" class="thumb" data-gallery-index="2">
                            <img src="{{asset('portal/assets/img/services/services-2.webp')}}" class="card-img-top"
                                alt="Gallery Image 3">
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title">Judul Foto 3</h5>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100">
                        <a href="#" class="thumb" data-gallery-index="3">
                            <img src="{{asset('portal/assets/img/services/services-4.webp')}}" class="card-img-top"
                                alt="Gallery Image 4">
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title">Judul Foto 4</h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Modal + Carousel gallery -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content bg-black border-0">
                <div class="modal-body p-0 position-relative d-flex justify-content-center align-items-center">

                    <!-- Tombol Close -->
                    <button type="button" class="btn-close btn-close-white position-absolute"
                        style="top:1rem; right:1rem; z-index:2000;" data-bs-dismiss="modal"></button>

                    <!-- Carousel -->
                    <div id="carouselGallery" class="carousel slide w-100 h-100" data-bs-ride="false"
                        data-bs-interval="false">
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <img src="{{asset('portal/assets/img/services/services-1.webp')}}"
                                        alt="Gallery Image 1">
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <img src="{{asset('portal/assets/img/services/services-2.webp')}}"
                                        alt="Gallery Image 2">
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <img src="{{asset('portal/assets/img/services/services-2.webp')}}"
                                        alt="Gallery Image 3">
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <img src="{{asset('portal/assets/img/services/services-4.webp')}}"
                                        alt="Gallery Image 4">
                                </div>
                            </div>

                        </div>

                        <!-- Nav prev/next -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselGallery"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselGallery"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script: pastikan bootstrap.bundle.min.js sudah dimuat sebelum ini script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var galleryModalEl = document.getElementById('galleryModal');
            var carouselEl = document.getElementById('carouselGallery');
            var bsCarousel = new bootstrap.Carousel(carouselEl, { interval: false, ride: false });
            var bsModal = new bootstrap.Modal(galleryModalEl, {});
            var thumbs = document.querySelectorAll('.thumb[data-gallery-index]');
            var targetIndex = 0;

            thumbs.forEach(function (thumb) {
                thumb.addEventListener('click', function (e) {
                    e.preventDefault();
                    targetIndex = parseInt(thumb.getAttribute('data-gallery-index'), 10) || 0;
                    bsModal.show();
                });
            });

            galleryModalEl.addEventListener('shown.bs.modal', function () {
                bsCarousel.to(targetIndex);
            });

            galleryModalEl.addEventListener('hidden.bs.modal', function () {
                bsCarousel.to(0);
            });
        });
    </script>

</div>