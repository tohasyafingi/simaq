<div>

  <!-- Hero Section -->
  <section id="hero" class="hero section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row align-items-center">

        <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="200">
          <div class="hero-content">
            <h1 class="hero-title">Creating Digital Experiences That Matter</h1>
            <p class="hero-description">We craft beautiful, functional, and meaningful digital solutions that help
              businesses connect with their audiences in authentic ways.</p>
            <div class="hero-actions">
              <a href="#about" class="btn-primary">Start Your Journey</a>
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="btn-secondary glightbox">
                <i class="bi bi-play-circle"></i>
                <span>Watch Our Story</span>
              </a>
            </div>
            <div class="hero-stats">
              {{-- <div class="stat-item">
                <span class="stat-number">3</span>
                <span class="stat-label">Program jurusan</span>
              </div>
              <div class="stat-item">
                <span class="stat-number">1234</span>
                <span class="stat-label">Siswa Aktif</span>
              </div>
              <div class="stat-item">
                <span class="stat-number">99</span>
                <span class="stat-label">Guru dan Staff</span>
              </div> --}}
            </div>
          </div>
        </div>

        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="300">
          <div class="hero-visual">
            <div class="hero-image-wrapper">
              <img src="{{asset('portal/assets/img/illustration/illustration-15.webp')}}" class="img-fluid hero-image"
                alt="Hero Image">
              <div class="floating-elements">
                <div class="floating-card card-1">
                  <i class="bi bi-lightbulb"></i>
                  <span>Innovation</span>
                </div>
                <div class="floating-card card-2">
                  <i class="bi bi-award"></i>
                  <span>Excellence</span>
                </div>
                <div class="floating-card card-3">
                  <i class="bi bi-people"></i>
                  <span>Collaboration</span>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </section><!-- /Hero Section -->

  <!-- About Section -->
  <section id="about" class="about section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-5">

        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
          <div class="content-wrapper">
            <div class="section-header">
              <span class="section-badge">ABOUT ME</span>
              <h2>Profil MA Takhassus Al-Qur'an Wonosobo</h2>
            </div>

            <p class="description-text">Bertolak dari gagasan luhur KH. Ahmad Faqih Muntaha untuk menciptakan pendidikan
              yang
              berkualitas namun terjangkau oleh masyarakat menengah ke bawah, Yayasan Al-Asy'ariyyah pada tahun 2008
              mendirikan sekolah setingkat SMA yang diberi nama Madrasah Aliyah Takhassus Al-Qur'an.
              Alumninya diharapkan dapat menciptakan atau mengisi lapangan kerja dan bagi yang melanjutkan ke jenjang
              perguruan tinggi bisa berkompetensi dengan yang lain.</p>
          </div>
        </div>

        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
          <div class="visual-section">
            <div class="main-image-container">
              <img src="{{ asset('portal/assets/img/about/about-8.webp')}}" alt="Professional team collaboration"
                class="img-fluid main-visual">
              <div class="overlay-card">
                <div class="card-content">
                  <h4>Quality First</h4>
                  <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis.</p>
                  <div class="card-icon">
                    <i class="bi bi-award-fill"></i>
                  </div>
                </div>
              </div>
            </div>

            {{-- <div class="secondary-images">
              <div class="row g-3">
                <div class="col-6">
                  <img src="{{ asset('portal/assets/img/about/about-11.webp')}}" alt="Team meeting"
                    class="img-fluid secondary-img">
                </div>
                <div class="col-6">
                  <img src="{{ asset('portal/assets/img/about/about-5.webp')}}" alt="Office workspace"
                    class="img-fluid secondary-img">
                </div>
              </div>
            </div> --}}
          </div>
        </div>

      </div>

    </div>

  </section><!-- /About Section -->

  <section class="services section">
    <div class="container pt-3" data-aos="fade-up" data-aos-delay="100">

      <div class="container section-title">
        <span class="description-title">Berita Terbaru</span>
        <h2>Berita Terbaru</h2>
      </div>

      <div class="services-grid mt-5">
        <div class="row g-4">
          @forelse($beritas as $berita)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="service-card">
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
  </section>

  <!-- Testimonials Section -->
  <section id="testimonials" class="testimonials section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <span class="description-title">Quote of the Day</span>
      <h2>Quote of the Day</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="testimonial-masonry">

        <div class="testimonial-item" data-aos="fade-up">
          <div class="testimonial-content">
            <div class="quote-pattern">
              <i class="bi bi-quote"></i>
            </div>
            <p>Implementing innovative strategies has revolutionized our approach to market challenges and competitive
              positioning.</p>
            <div class="client-info">
              <div class="client-image">
                <img src="{{ asset('portal/assets/img/person/person-f-7.webp')}}" alt="Client">
              </div>
              <div class="client-details">
                <h3>Rachel Bennett</h3>
                <span class="position">Strategy Director</span>
              </div>
            </div>
          </div>
        </div>

        <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="100">
          <div class="testimonial-content">
            <div class="quote-pattern">
              <i class="bi bi-quote"></i>
            </div>
            <p>Exceptional service delivery and innovative solutions have transformed our business operations, leading
              to remarkable growth and enhanced customer satisfaction across all touchpoints.</p>
            <div class="client-info">
              <div class="client-image">
                <img src="{{ asset('portal/assets/img/person/person-m-7.webp')}}" alt="Client">
              </div>
              <div class="client-details">
                <h3>Daniel Morgan</h3>
                <span class="position">Chief Innovation Officer</span>
              </div>
            </div>
          </div>
        </div>

        <div class="testimonial-item" data-aos="fade-up" data-aos-delay="200">
          <div class="testimonial-content">
            <div class="quote-pattern">
              <i class="bi bi-quote"></i>
            </div>
            <p>Strategic partnership has enabled seamless digital transformation and operational excellence.</p>
            <div class="client-info">
              <div class="client-image">
                <img src="{{ asset('portal/assets/img/person/person-f-8.webp')}}" alt="Client">
              </div>
              <div class="client-details">
                <h3>Emma Thompson</h3>
                <span class="position">Digital Lead</span>
              </div>
            </div>
          </div>
        </div>

        <div class="testimonial-item" data-aos="fade-up" data-aos-delay="300">
          <div class="testimonial-content">
            <div class="quote-pattern">
              <i class="bi bi-quote"></i>
            </div>
            <p>Professional expertise and dedication have significantly improved our project delivery timelines and
              quality metrics.</p>
            <div class="client-info">
              <div class="client-image">
                <img src="{{ asset('portal/assets/img/person/person-m-8.webp')}}" alt="Client">
              </div>
              <div class="client-details">
                <h3>Christopher Lee</h3>
                <span class="position">Technical Director</span>
              </div>
            </div>
          </div>
        </div>

        <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="400">
          <div class="testimonial-content">
            <div class="quote-pattern">
              <i class="bi bi-quote"></i>
            </div>
            <p>Collaborative approach and industry expertise have revolutionized our product development cycle,
              resulting in faster time-to-market and increased customer engagement levels.</p>
            <div class="client-info">
              <div class="client-image">
                <img src="{{ asset('portal/assets/img/person/person-f-9.webp')}}" alt="Client">
              </div>
              <div class="client-details">
                <h3>Olivia Carter</h3>
                <span class="position">Product Manager</span>
              </div>
            </div>
          </div>
        </div>

        <div class="testimonial-item" data-aos="fade-up" data-aos-delay="500">
          <div class="testimonial-content">
            <div class="quote-pattern">
              <i class="bi bi-quote"></i>
            </div>
            <p>Innovative approach to user experience design has significantly enhanced our platform's engagement
              metrics and customer retention rates.</p>
            <div class="client-info">
              <div class="client-image">
                <img src="{{ asset('portal/assets/img/person/person-m-13.webp')}}" alt="Client">
              </div>
              <div class="client-details">
                <h3>Nathan Brooks</h3>
                <span class="position">UX Director</span>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </section><!-- /Testimonials Section -->

</div>