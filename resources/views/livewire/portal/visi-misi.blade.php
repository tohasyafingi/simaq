<div>
    <!-- ===== Banner Section Start ===== -->
    <section class="hero-section" style="height: 200px;">
        <div class="hero-content text-center">
            <h1>Visi & Misi</h1>
        </div>
    </section>
    <!-- ===== Banner Section End ===== -->

    <!-- ===== Content Section Start ===== -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">

                    <!-- ===== Image Section ===== -->
                    @if($visi && $visi->image)
                    <div class="text-center mb-5">
                        <img src="{{ asset('storage/'.$visi->image) }}" alt="Visi & Misi" class="img-fluid rounded">
                    </div>
                    @endif

                    <!-- ===== Vision Section ===== -->
                    <div class="mb-5">
                        <h2 class="section-title text-center">Visi</h2>
                        @if($visi)
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <p style="font-size: 1.25rem; line-height: 1.8;">
                                    {!! $visi->content !!}
                                </p>
                            </div>
                        </div>
                        @else
                        <div class="alert alert-warning text-center">Konten visi belum tersedia.</div>
                        @endif
                    </div>

                    <!-- ===== Mission Section ===== -->
                    <div class="mb-5">
                        <h2 class="section-title text-center">Misi</h2>
                        @if($misi)
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <p style="font-size: 1.5rem; line-height: 2;">
                                    {!! $misi->content !!}
                                </p>
                            </div>
                        </div>
                        @else
                        <div class="alert alert-warning text-center">Konten misi belum tersedia.</div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ===== Content Section End ===== -->
</div>