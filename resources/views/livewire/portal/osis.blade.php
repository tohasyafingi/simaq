<div>
    <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
        <div class="container text-center">
            <h1 data-aos="fade-down" data-aos-duration="800">
            {{ $activities->first()->judul ?? 'OSIM' }}
            </h1>
        </div>
    </section>

    <section class="section">
        <div class="container">
            
            @forelse($activities as $activity)
            <div class="row align-items-start justify-content-center">
                @if($activity->image)
                <div class="col-lg-6" data-aos="zoom-in">
                    <img src="{{ asset('storage/'.$activity->image) }}" 
                         alt="{{ $activity->judul }}" loading="lazy"
                         class="img-fluid rounded mb-4 mb-lg-0">
                </div>
                @endif
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="content-text" data-aos="fade-up" data-aos-delay="80">
                        {!! $activity->content !!}
                    </div>
                    @if($activity->link)
                    <a href="{{ $activity->link }}" target="_blank" class="btn btn-primary mt-3" data-aos="fade-up" data-aos-delay="160">Learn More</a>
                    @endif
                </div>

            </div>
            @empty
                <div class="alert alert-warning text-center">
                    Konten OSIS belum tersedia.
                </div>
            @endforelse
        </div>
    </section>
</div>
