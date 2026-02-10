<div>
  <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
    <div class="container text-center">
      <h1 data-aos="fade-down" data-aos-duration="800">Perpustakaan Digital</h1>
    </div>
  </section>

  <section class="section pt-3 pb-4">
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
          <input
            type="text"
            class="form-control"
            placeholder="Search e-book..."
            wire:model.live="search">
        </div>
      </div>
    </div>
  </section>

  <section class="section" data-aos="fade-up" data-aos-duration="800">
    <div class="container">
      <div class="row mb-5">
        @forelse($books as $book)
        <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="120">
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

              {{-- ACTIONS --}}
              <div class="mt-auto">
                <div class="d-flex gap-2">
                  @if($book->link || $book->file)
                  <a
                    wire:navigate
                    href="{{ route('pdf-viewer', ['book' => $book->slug ?? $book->id]) }}"
                    class="btn btn-primary btn-sm flex-grow-1">
                    Lihat Detail
                  </a>
                  @endif

                  <button
                    type="button"
                    class="btn btn-sm btn-social btn-native"
                    title="Bagikan buku"
                    x-on:click.stop="shareArtikel('{{ $book->slug ?? $book->id }}')">
                    <i class="bi bi-share-fill"></i>
                  </button>
                </div>
              </div>
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

@script
<script>
  window.shareArtikel = function(slug) {
    const url = `${window.location.origin}/e-book/${slug}`;

    if (navigator.share) {
      navigator.share({
        title: 'Perpustakaan Digital',
        url: url
      });
    } else {
      navigator.clipboard.writeText(url)
        .then(() => alert('Link e-book berhasil disalin'));
    }
  }
</script>
@endscript