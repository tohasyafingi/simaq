<div>
    <!-- Services Section -->
    <section id="services" class="services section">

        <!-- Section Title -->
        <div class="container section-title">
            <span class="description-title">Berita dan Agenda</span>
            <h2>Berita dan Agenda</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="services-grid mt-5">
                <div class="row g-4">
                    @forelse($beritas as $berita)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="service-card">
                                <!-- Gambar Thumbnail -->
                                <div class="card-image">
                                    <img src="{{ $berita->thumbnail_url ?? asset('portal/assets/img/services/services-1.webp') }}"
                                        alt="{{ $berita->judul }}">
                                </div>
                                <div class="card-content">
                                    <h5 class="service-title">
                                        <a href="{{ route('detail-berita-agenda', ['slug' => $berita->slug]) }}">
                                            {{ $berita->judul }}
                                        </a>
                                    </h5>
                                    <p class="service-description">
                                        {!! \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120, '...') !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">Belum ada berita publik tersedia.</p>
                    @endforelse
                </div>
            </div>

        </div>

    </section><!-- /Services Section -->

</div>