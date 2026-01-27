<div>
  <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
    <div class="container text-center">
      <h1 data-aos="fade-down" data-aos-duration="800">Karya Ilmiah</h1>
    </div>
  </section>

  <section class="section pt-3 pb-4">
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
          <input
            type="text"
            class="form-control"
            placeholder="Search karya ilmiah..."
            wire:model.live="search">
        </div>
      </div>
    </div>
  </section>

  <section class="section" data-aos="fade-up" data-aos-duration="800">
    <div class="container">

      @if ($karya_ilmiahs->count())
      <div class="row g-4">

        @foreach ($karya_ilmiahs as $karya)
        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up">

          <article class="card h-100 position-relative" data-aos="zoom-in">

            {{-- Thumbnail --}}
            <img
              src="{{ $karya->thumbnail_url ?? asset('assets/karya.webp') }}"
              class="card-img-top"
              alt="{{ $karya->judul }}"
              loading="lazy">

            {{-- Kategori --}}
            <span class="badge-category">
              {{ $karya->kategori->nama ?? 'Umum' }}
            </span>

            {{-- Body --}}
            <div class="card-body d-flex flex-column">

              <h5 class="card-title">
                {{ $karya->judul }}
              </h5>

              <p class="card-text text-muted mb-2">
                <small>
                  <i class="fas fa-calendar"></i>
                  {{ $karya->created_at->format('d/m/Y') }}
                </small>
              </p>

              <p class="card-text flex-grow-1">
                {{ \Illuminate\Support\Str::limit(strip_tags($karya->isi), 120) }}
              </p>

              <a
                wire:navigate
                href="{{ route('detail-karya-ilmiah', $karya->slug) }}"
                class="btn btn-primary btn-sm mt-auto"
                aria-label="Baca karya ilmiah {{ $karya->judul }}">
                Baca Selengkapnya
              </a>

            </div>
          </article>

        </div>
        @endforeach

      </div>

      {{-- PAGINATION --}}
      <div class="d-flex justify-content-center mt-5">
        {{ $karya_ilmiahs->links() }}
      </div>

      @else
      <div class="alert alert-warning text-center">
        Konten karya ilmiah belum tersedia.
      </div>
      @endif

    </div>
  </section>

</div>