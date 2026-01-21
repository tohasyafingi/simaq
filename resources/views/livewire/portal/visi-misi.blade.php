<div>
    <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
        <div class="container text-center">
            <h1>Visi & Misi</h1>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">

                    @if($visi && $visi->image)
                    <div class="text-center mb-5">
                        <img src="{{ asset('storage/'.$visi->image) }}" alt="Visi & Misi" class="img-fluid rounded">
                    </div>
                    @endif

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
</div>