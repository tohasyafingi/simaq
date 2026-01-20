<div>
    <!-- ===== Banner Section Start ===== -->
    <section class="hero-section" style="height: 200px;">
        <div class="hero-content text-center">
            <h1>Ekstrakurikuler</h1>
        </div>
    </section>
    <!-- ===== Banner Section End ===== -->

    <!-- ===== Content Section Start ===== -->
    <section class="section">
        <div class="container">
            <div class="row mb-5">

                @forelse($activities as $activity)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        @if($activity->image)
                        <img src="{{ asset('storage/'.$activity->image) }}" class="card-img-top" alt="{{ $activity->judul }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $activity->judul }}</h5>
                            <div class="card-text">
                                {!! $activity->content !!}
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-warning text-center">
                    Konten ekstrakurikuler belum tersedia.
                </div>
                @endforelse

            </div>
        </div>
    </section>
    <!-- ===== Content Section End ===== -->
</div>