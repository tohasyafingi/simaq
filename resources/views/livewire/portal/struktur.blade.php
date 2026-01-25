<div>
  <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
        <div class="container text-center">
      <h1 data-aos="fade-down" data-aos-duration="800">Struktur Organisasi</h1>
    </div>
  </section>

  <section class="section" data-aos="fade-up" data-aos-duration="800">
    <div class="container">
      <div class="row mb-5">
        @forelse($strukturs as $struktur)
        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="80">
          <div class="card text-center">
            <img
              src="{{ $struktur->user && $struktur->user->img ? asset('storage/' . $struktur->user->img) : asset('assets/default-image.webp') }}"
              class="card-img-top"
              alt="{{ $struktur->jabatan }}" loading="lazy" data-aos="zoom-in">
            <div class="card-body">
              <h5 class="card-title">{{ $struktur->user->name }}</h5>
              <p class="card-text text-muted">{{ $struktur->jabatan }}</p>
              @if(!empty($struktur->deskripsi))
              <p class="card-text" style="font-size: 0.9rem;">{{ $struktur->deskripsi }}</p>
              @endif
            </div>
          </div>
        </div>
        @empty
        <div class="alert alert-warning text-center">
          Konten struktur organisasi belum tersedia.
        </div>
        @endforelse
      </div>
    </div>
  </section>
</div>