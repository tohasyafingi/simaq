<div class="news-page">

<!-- ===== Banner Section Start ===== -->
<section class="hero-section" style="height: 300px;">
  <div class="hero-content text-center">
    <h1>News & Updates</h1>
    <p>Latest Stories from SMA School</p>
  </div>
</section>
<!-- ===== Banner Section End ===== -->

<!-- ===== Content Section Start ===== -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Recent News</h2>

    <div class="row mb-5">
      <div class="col-lg-4 mb-4">
        <div class="card">
          <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="News 1">
          <div class="card-body">
            <h5 class="card-title">Annual School Festival 2024</h5>
            <p class="card-text text-muted"><small><i class="fas fa-calendar"></i> November 5, 2024</small></p>
            <p class="card-text">Join us for our spectacular annual festival featuring performances, exhibitions, art displays, and cultural celebrations showcasing student talent.</p>
            <a href="news-detail.html" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card">
          <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="News 2">
          <div class="card-body">
            <h5 class="card-title">Scholarship Opportunities Available</h5>
            <p class="card-text text-muted"><small><i class="fas fa-calendar"></i> October 28, 2024</small></p>
            <p class="card-text">We are proud to announce new scholarship opportunities for deserving students. Apply now to secure your future education at SMA School.</p>
            <a href="news-detail.html" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card">
          <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="News 3">
          <div class="card-body">
            <h5 class="card-title">New Science Lab Inauguration</h5>
            <p class="card-text text-muted"><small><i class="fas fa-calendar"></i> October 20, 2024</small></p>
            <p class="card-text">Our state-of-the-art science laboratory is now ready to provide hands-on learning experiences with the latest equipment for students.</p>
            <a href="news-detail.html" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card">
          <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="News 4">
          <div class="card-body">
            <h5 class="card-title">Basketball Team Wins Regional Championship</h5>
            <p class="card-text text-muted"><small><i class="fas fa-calendar"></i> October 15, 2024</small></p>
            <p class="card-text">Congratulations to our basketball team on winning the regional championship! An outstanding achievement by our dedicated athletes.</p>
            <a href="news-detail.html" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card">
          <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="News 5">
          <div class="card-body">
            <h5 class="card-title">International Exchange Program Launched</h5>
            <p class="card-text text-muted"><small><i class="fas fa-calendar"></i> October 8, 2024</small></p>
            <p class="card-text">SMA School is launching a new international exchange program providing students opportunities to study abroad and gain global perspective.</p>
            <a href="news-detail.html" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card">
          <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="News 6">
          <div class="card-body">
            <h5 class="card-title">Environmental Awareness Campaign</h5>
            <p class="card-text text-muted"><small><i class="fas fa-calendar"></i> September 30, 2024</small></p>
            <p class="card-text">Students and staff participate in an environmental awareness campaign to promote sustainability and protect our planet.</p>
            <a href="news-detail.html" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center">
      <a href="scientific-works.html" class="btn btn-primary me-2">Scientific Works</a>
      <a href="../index.html" class="btn btn-secondary">Back to Home</a>
    </div>
  </div>
</section>
<!-- ===== Content Section End ===== -->

    {{-- <div class="container mb-5">
        <div class="row">
            <div class="col-lg-8">
                @forelse($beritas as $berita)
                    <div class="card news-card">
                        <img src="{{ $berita->thumbnail_url ?? asset('portal/images/default.jpg') }}" class="news-image"
                            alt="{{ $berita->judul }}">
                        <div class="card-body">
                            <span class="news-category">{{ $berita->kategori->nama ?? 'Uncategorized' }}</span>
                            <p class="news-date"><i class="bi bi-calendar3"></i> January 15, 2025</p>
                            <h3 class="card-title">{{ $berita->judul }}</h3>
                            <p class="card-text">
                                {!! \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120, '...') !!}
                            </p>
                            <div class="mt-3">
                                <span class="badge bg-light text-dark me-2"><i class="bi bi-eye"></i> 1,234 views</span>
                                <span class="badge bg-light text-dark"><i class="bi bi-chat"></i> 45 comments</span>
                            </div>
                            <a href="{{ route('detail-berita-agenda', ['slug' => $berita->slug]) }}"
                                class="btn btn-read-more mt-3">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Belum ada berita publik tersedia.</p>
                @endforelse
            </div>
        </div>
    </div> --}}

</div>