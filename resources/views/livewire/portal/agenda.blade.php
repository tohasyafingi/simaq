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

      @if ($beritas->count())
      <div class="row g-4">

        @foreach ($beritas as $berita)
        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up">

          <article class="card h-100 position-relative" data-aos="zoom-in">

            {{-- Thumbnail --}}
            <img
              src="{{ \App\Helpers\ImageHelper::url($berita->thumbnail) ?? asset('assets/berita.webp') }}"
              class="card-img-top"
              alt="{{ $berita->judul }}"
              loading="lazy">

            {{-- Kategori --}}
            <span class="badge-category">
              {{ $berita->kategori->nama ?? 'Umum' }}
            </span>

            {{-- Body --}}
            <div class="card-body d-flex flex-column">

              <h5 class="card-title">
                {{ $berita->judul }}
              </h5>

              <p class="card-text text-muted mb-2">
                <small>
                  <i class="fas fa-calendar"></i>
                  {{ $berita->created_at->format('d/m/Y') }}
                </small>
              </p>

              <p class="card-text flex-grow-1">
                {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120) }}
              </p>

              <a
                wire:navigate
                href="{{ route('detail-berita-agenda', $berita->slug) }}"
                class="btn btn-primary btn-sm mt-auto"
                aria-label="Baca berita {{ $berita->judul }}">
                Baca Selengkapnya
              </a>

            </div>
          </article>

        </div>
        @endforeach

      </div>

      {{-- PAGINATION --}}
      <div class="d-flex justify-content-center mt-5">
        {{ $beritas->links() }}
      </div>

      @else
      <div class="alert alert-warning text-center">
        Konten berita belum tersedia.
      </div>
      @endif

    </div>
  </section>
</div>