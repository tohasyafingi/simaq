<div class="news-page">

  <!-- ===== Banner Section Start ===== -->
  <section class="hero-section" style="height: 200px;">
    <div class="hero-content text-center">
      <h1>Berita & Agenda</h1>
    </div>
  </section>
  <!-- ===== Banner Section End ===== -->

  <!-- ===== Search & Content Section Start ===== -->
  <section class="section pt-3 pb-4">
    <div class="container">
      <!-- Search bar -->
      <div class="d-flex justify-content-end mb-3">
        <input type="text" class="form-control w-25" placeholder="Search berita..." wire:model.live="search">
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      @forelse($beritas->chunk(3) as $chunk)
      <div class="row mb-5">
        @foreach($chunk as $berita)
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
                <small><i class="fas fa-calendar"></i> {{ $berita->created_at->format('d/m/Y') }}</small>
              </p>
              <p class="card-text">{!! \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120, '...') !!}</p>
              <a href="{{ route('detail-berita-agenda', ['slug' => $berita->slug]) }}"
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

      <!-- Pagination -->
      <div class="d-flex justify-content-center">
        {{ $beritas->links() }}
      </div>

    </div>
  </section>
  <!-- ===== Content Section End ===== -->

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