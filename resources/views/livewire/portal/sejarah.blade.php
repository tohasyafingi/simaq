<div>
    <!-- ===== Banner Section Start ===== -->
    <section class="hero-section" style="height: 200px;">
        <div class="hero-content text-center">
            <h1>Sejarah</h1>
        </div>
    </section>
    <!-- ===== Banner Section End ===== -->

    <!-- ===== Content Section Start ===== -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">

                    @if($sejarah)
                    @if($sejarah->image)
                    <div class="text-center mb-4">
                        <img
                        src="{{ asset('storage/'.$sejarah->image) }}"
                        alt="{{ $sejarah->judul }}"
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
    <!-- ===== Content Section End ===== -->
</div>