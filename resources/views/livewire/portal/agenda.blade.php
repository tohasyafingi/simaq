<div class="news-page">
    <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
    <div class="container text-center">
      <h1 data-aos="fade-down" data-aos-duration="800">Berita & Agenda</h1>
    </div>
  </section>

  <section class="section pt-3 pb-4">
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
          <input
            type="text"
            class="form-control"
            placeholder="Search berita..."
            wire:model.live="search">
        </div>
      </div>
    </div>
  </section>

  <section class="section" data-aos="fade-up" data-aos-duration="800">
    <div class="container">
      @forelse($beritas->chunk(3) as $chunk)
      <div class="row mb-5">
        @foreach($chunk as $berita)
        <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
          <div class="card position-relative">
            <img src="{{ $berita->thumbnail_url ?? asset('assets/berita.webp') }}" class="card-img-top"
              alt="{{ $berita->judul }}" loading="lazy">

            <span class="badge-category">
              {{ $berita->kategori->nama ?? 'Umum' }}
            </span>

            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ $berita->judul }}</h5>
              <p class="card-text text-muted">
                <small><i class="fas fa-calendar"></i> {{ $berita->created_at->format('d/m/Y') }}</small>
              </p>
              <p class="card-text">{!! \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120, '...') !!}</p>
              <a wire:navigate href="{{ route('detail-berita-agenda', ['slug' => $berita->slug]) }}"
                class="btn btn-primary btn-sm">Baca Selengkapnya</a>
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

      <div class="d-flex justify-content-center">
        {{ $beritas->links() }}
      </div>

    </div>
  </section>

  <style>
    .card {
      position: relative;
    }
  </style>
</div>