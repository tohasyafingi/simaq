<div>
  <!-- ===== Banner Section Start ===== -->
  <section class="hero-section" style="height: 200px;">
    <div class="hero-content text-center">
      <h1>Scientific Works</h1>
      <p>Student Research & Innovation</p>
    </div>
  </section>
  <!-- ===== Banner Section End ===== -->

  <!-- ===== Content Section Start ===== -->
  <section class="section">
    <div class="container">

      <!-- Search bar -->
      <div class="d-flex justify-content-end mb-3">
        <input type="text" class="form-control w-25" placeholder="Search karya ilmiah..." wire:model.live="search">
      </div>

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
                  <a href="{{ route('detail-karya-ilmiah', ['slug' => $karya_ilmiah->slug]) }}"
                    class="btn btn-primary btn-sm">Read More</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @empty
        <p class="text-center">Belum ada karya ilmiah tersedia.</p>
      @endforelse

      <!-- Pagination -->
      <div class="d-flex justify-content-center">
        {{ $karya_ilmiahs->links() }}
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