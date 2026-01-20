<div>
  <!-- ===== Banner Section Start ===== -->
  <section class="hero-section" style="height: 200px;">
    <div class="hero-content text-center">
      <h1>Perpustakaan Digital</h1>
    </div>
  </section>
  <!-- ===== Banner Section End ===== -->

  <!-- ===== Search Section ===== -->
  <section class="section pt-3 pb-4">
    <div class="container">
      <!-- Search bar -->
      <div class="d-flex justify-content-end mb-3">
        <input type="text" class="form-control w-25" placeholder="Search e-book..." wire:model.live="search">
      </div>
    </div>
  </section>

  <!-- ===== Content Section Start ===== -->
  <section class="section">
    <div class="container">
      <div class="row mb-5">
        @forelse($books as $book)
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card h-100">
            @if($book->image)
            <img src="{{ asset('storage/'.$book->image) }}"
              class="card-img-top"
              alt="{{ $book->judul }}"
              style="height: 300px; object-fit: cover;">
            @endif
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ $book->judul }}</h5>
              @if($book->description)
              <p class="card-text">{{ $book->description }}</p>
              @endif
              @if($book->link || $book->file)
              <a href="{{ $book->link ?? asset('storage/'.$book->file) }}"
                target="_blank"
                class="btn btn-primary btn-sm mt-auto">
                Lihat Detail
              </a>
              @endif
            </div>
          </div>
        </div>
        @empty
        <div class="col-12">
          <div class="alert alert-warning text-center">
            Belum ada E-Book tersedia.
          </div>
        </div>
        @endforelse
      </div>

      <!-- Pagination -->
      <div class="d-flex justify-content-center">
        {{ $books->links() }}
      </div>
    </div>
  </section>
  <!-- ===== Content Section End ===== -->
</div>