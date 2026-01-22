<div>
    <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
        <div class="container text-center">
            <h1>Sejarah</h1>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">

                    @if($sejarah)
                    @if($sejarah->image)
                    <div class="text-center mb-4">
                        <img
                            src="{{ asset('storage/'.$sejarah->image) }}"
                            alt="{{ $sejarah->judul }}" loading="lazy"
                            class="img-fluid rounded">
                    </div>
                    @endif

                    <h2 class="section-title">{{ $sejarah->judul }}</h2>

                    <div class="content-text">
                        {!! $sejarah->content !!}
                    </div>

                    @else
                    <div class="alert alert-warning text-center">
                        Konten sejarah belum tersedia.
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
</div>