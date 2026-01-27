<div>
    <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
        <div class="container text-center">
            <h1 data-aos="fade-down" data-aos-duration="800">SPMB</h1>
        </div>
    </section>

    <section class="section">
        <div class="container">

            @forelse($activities as $activity)
            <h2 class="section-title" data-aos="fade-up">{{ $activity->judul }}</h2>
            <div class="row align-items-start justify-content-center">
                @if($activity->image)
                <div class="col-lg-6" data-aos="zoom-in">
                    <img src="{{ asset('storage/'.$activity->image) }}"
                        alt="{{ $activity->judul }}" loading="lazy"
                        class="img-fluid rounded mb-3 mb-lg-0" />
                </div>
                @endif

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="80">
                    <div class="content-text">{!! $activity->content !!}</div>
                </div>
            </div>

            @if($activity->link)
            <div class="text-center">
                <a href="{{ $activity->link }}"
                    class="btn btn-primary"
                    target="_blank"
                    rel="noopener">
                    Daftar Sekarang
                </a>
            </div>
            @endif

            @empty
            <div class="alert alert-warning text-center">
                Konten PPDB belum tersedia.
            </div>
            @endforelse

        </div>
    </section>
</div>