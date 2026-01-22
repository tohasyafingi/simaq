<div>
  <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
        <div class="container text-center">
      <h1>Perpustakaan Digital</h1>
    </div>
  </section>

  <section class="section pt-3 pb-4">
    <div class="container">
      <div class="d-flex justify-content-end mb-3">
        <input type="text" class="form-control w-25" placeholder="Search e-book..." wire:model.live="search">
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="row mb-5">
        @forelse($books as $book)
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card h-100">
            @if($book->image)
            <img src="{{ asset('storage/'.$book->image) }}"
              class="card-img-top"
              alt="{{ $book->judul }}" loading="lazy"
              style="height: 300px; object-fit: cover;">
            @endif
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ $book->judul }}</h5>
              @if($book->description)
              <p class="card-text">{{ $book->description }}</p>
              @endif
              @if($book->link || $book->file)
              <a href="{{ route('pdf-viewer', $book->id) }}" class="btn btn-primary btn-sm mt-auto">
                Lihat Detail
              </a>
              {{-- <a href="{{ asset('storage/'.$book->file) }}" class="btn btn-primary btn-sm mt-auto" target="_blank" rel="noopener noreferrer">
                Lihat Detail
              </a> --}}
              @endif
            </div>
          </div>
        </div>
        @empty
        <div class="alert alert-warning text-center">
          Konten e-book belum tersedia.
        </div>
        @endforelse
      </div>

      <div class="d-flex justify-content-center">
        {{ $books->links() }}
      </div>
    </div>
  </section>
</div>