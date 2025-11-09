<div>

    <!-- ===== Hero Section Start ===== -->
    <section class="hero-section">
        <div class="hero-content text-center">
            <h3>Selamat Datang di</h3>
            <h1>MA takhassus Al-Qur'an Wonosobo</h1>
            <p>Building Leaders, Inspiring Minds, Creating Tomorrow</p>
            <a href="#about" class="btn btn-primary">Learn More</a>
        </div>
    </section>
    <!-- ===== Hero Section End ===== -->

    <!-- ===== About Section Start ===== -->
    <section id="about" class="section bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="section-title mb-4">About Us</h2>
                    <p class="mb-3">
                        Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                        pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean
                        sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa
                        nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti
                        sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.
                    </p>
                    <p class="mb-3">
                        Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                        pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean
                        sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa
                        nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti
                        sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos..
                    </p>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('assets/tentang.webp') }}" alt="About SMA School" class="img-fluid rounded" />
                </div>
            </div>
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
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="{{ asset('assets/galeri.webp') }}" alt="Gallery Image 1" />
                    <div class="gallery-overlay">
                        <h5>Graduation Ceremony 2024</h5>
                        <p class="mb-0">Celebrating our graduating class</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/galeri.webp') }}" alt="Gallery Image 2" />
                    <div class="gallery-overlay">
                        <h5>Graduation Ceremony 2024</h5>
                        <p class="mb-0">Celebrating our graduating class</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/galeri.webp') }}" alt="Gallery Image 3" />
                    <div class="gallery-overlay">
                        <h5>Graduation Ceremony 2024</h5>
                        <p class="mb-0">Celebrating our graduating class</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/galeri.webp') }}" alt="Gallery Image 4" />
                    <div class="gallery-overlay">
                        <h5>Graduation Ceremony 2024</h5>
                        <p class="mb-0">Celebrating our graduating class</p>
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
            <h2 class="section-title">Admission (PPDB) 2024</h2>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="{{ asset('assets/ppdb.webp') }}" alt="Admission" class="img-fluid rounded mb-3 mb-lg-0" />
                </div>
                <div class="col-lg-6">
                    <p class="mb-3">
                        We are now accepting applications for the 2024-2025
                        academic year. Join our community of excellence and
                        unlock your potential.
                    </p>
                    <h5 class="mb-3">
                        Application Deadline: December 31, 2024
                    </h5>
                    <ul class="mb-3">
                        <li>Complete secondary school education</li>
                        <li>Academic excellence</li>
                        <li>Positive character references</li>
                        <li>Participation in extracurricular activities</li>
                    </ul>
                    <a wire:navigate href="{{route('ppdb')}}" class="btn btn-primary">Register Now</a>
                </div>
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
                        width="100%" height="300" style="border: 0; border-radius: 8px" allowfullscreen=""
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
    </style>
</div>