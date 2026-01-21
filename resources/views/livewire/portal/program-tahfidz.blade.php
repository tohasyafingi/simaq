<div>
    <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
        <div class="container text-center">
            <h1>Program Tahfidz Al-Qur'an</h1>
        </div>
    </section>

    <section class="section">
        <div class="container">

            @forelse($activities as $activity)
            <div class="row align-items-start justify-content-center">
                @if($activity->image)
                <div class="col-lg-6">
                    <img src="{{ asset('storage/'.$activity->image) }}" 
                         alt="{{ $activity->judul }}" 
                         class="img-fluid rounded mb-4 mb-lg-0">
                </div>
                @endif

                <div class="col-lg-6">
                    <h2 class="section-title">{{ $activity->judul }}</h2>
                    <div class="content-text">
                        {!! $activity->content !!}
                    </div>

                    @if($activity->link)
                    <a href="{{ $activity->link }}" target="_blank" class="btn btn-primary mt-3">
                        Learn More
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <div class="alert alert-warning text-center">
                Konten Program Tahfidz belum tersedia.
            </div>
            @endforelse

        </div>
    </section>
</div>
