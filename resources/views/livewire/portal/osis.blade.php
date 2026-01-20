<div>
    <!-- ===== Banner Section Start ===== -->
    <section class="hero-section" style="height: 200px;">
        <div class="hero-content text-center">
            <h1>OSIS</h1>
        </div>
    </section>
    <!-- ===== Banner Section End ===== -->

    <!-- ===== Content Section Start ===== -->
    <section class="section">
        <div class="container">
            @forelse($activities as $activity)
                <div class="row align-items-center mb-5">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <h2 class="section-title">{{ $activity->judul }}</h2>
                        <div class="content-text">
                            {!! $activity->content !!}
                        </div>
                        @if($activity->link)
                        <a href="{{ $activity->link }}" target="_blank" class="btn btn-primary mt-3">Learn More</a>
                        @endif
                    </div>
                    @if($activity->image)
                    <div class="col-lg-6">
                        <img src="{{ asset('storage/'.$activity->image) }}" 
                             alt="{{ $activity->judul }}" 
                             class="img-fluid rounded">
                    </div>
                    @endif
                </div>
            @empty
                <div class="alert alert-warning text-center">
                    Konten OSIS belum tersedia.
                </div>
            @endforelse
        </div>
    </section>
    <!-- ===== Content Section End ===== -->
</div>
