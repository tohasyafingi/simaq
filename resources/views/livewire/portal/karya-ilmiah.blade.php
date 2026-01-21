<div>
  <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
        <div class="container text-center">
      <h1>Karya Ilmiah</h1>
    </div>
  </section>

  <section class="section pt-3 pb-4">
    <div class="container">
      <div class="d-flex justify-content-end mb-3">
        <input type="text" class="form-control w-25" placeholder="Search karya ilmiah..." wire:model.live="search">
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      @forelse($karya_ilmiahs->chunk(3) as $chunk)
      <div class="row mb-5">
        @foreach($chunk as $karya_ilmiah)
        <div class="col-lg-4 mb-4">
          <div class="card position-relative">
            <img src="{{ $karya_ilmiah->thumbnail_url ?? asset('assets/karya.webp') }}" class="card-img-top"
              alt="{{ $karya_ilmiah->judul }}" loading="lazy">
            <span class="badge-category">{{ $karya_ilmiah->kategori->nama ?? 'Umum' }}</span>
            <div class="card-body">
              <h5 class="card-title">{{ $karya_ilmiah->judul }}</h5>
              <p class="card-text text-muted"><small><i class="fas fa-calendar"></i>
                  {{ $karya_ilmiah->created_at->format('d/m/Y') }}</small></p>
              <p class="card-text">{!! \Illuminate\Support\Str::limit(strip_tags($karya_ilmiah->isi), 120, '...') !!}
              </p>
              <a wire:navigate href="{{ route('detail-karya-ilmiah', ['slug' => $karya_ilmiah->slug]) }}"
                class="btn btn-primary btn-sm">Baca Selengkapnya</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @empty
      <div class="alert alert-warning text-center">
        Konten karya ilmiah belum tersedia.
      </div>
      @endforelse

      <div class="d-flex justify-content-center">
        {{ $karya_ilmiahs->links() }}
      </div>

    </div>
  </section>

  <style>
    .card {
      position: relative;
    }
  </style>
</div>