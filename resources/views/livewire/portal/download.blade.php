<div>
    <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
        <div class="container text-center">
            <h1 data-aos="fade-down" data-aos-duration="800">Downloads</h1>
        </div>
    </section>

    <section class="section pt-3 pb-4">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Search downloads..."
                        wire:model.live="search">
                </div>
            </div>
        </div>
    </section>

    <section class="section" data-aos="fade-up" data-aos-duration="800">
        <div class="container">
            <div class="row mb-5">
                @forelse($downloads as $item)
                <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="120">
                    <div class="card h-100">
                        @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}"
                            class="card-img-top"
                            alt="{{ $item->judul }}" loading="lazy"
                            style="height: 250px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item->judul }}</h5>
                            @if($item->description)
                            <p class="card-text">{{ $item->description }}</p>
                            @endif
                            @if($item->file)
                            <button
                                wire:click="downloadFile({{ $item->id }})"
                                wire:loading.attr="disabled"
                                class="btn btn-primary btn-sm mt-auto">
                                <i class="fas fa-download"></i> Unduh
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-warning text-center">
                    Konten download belum tersedia.
                </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-center">
                {{ $downloads->links() }}
            </div>
        </div>
    </section>
</div>