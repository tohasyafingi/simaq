<div>
    <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
        <div class="container text-center">
            <h1 data-aos="fade-down" data-aos-duration="800">Visi & Misi</h1>
        </div>
    </section>

    <section class="section" data-aos="fade-up" data-aos-duration="800">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">

                    @if($visi && $visi->image)
                    <div class="text-center mb-5" data-aos="zoom-in">
                        <img src="{{ asset('storage/'.$visi->image) }}" alt="Visi & Misi" loading="lazy" class="img-fluid rounded">
                    </div>
                    @endif

                    <div class="mb-5">
                        <h2 class="section-title text-center" data-aos="fade-up">Visi</h2>
                        @if($visi)
                        <div class="card border-0 shadow-sm h-100" data-aos="fade-up" data-aos-delay="80">
                            <div class="card-body">
                                    <div class="content-view">
                                        {!! $visi->content !!}
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="alert alert-warning text-center">Konten visi belum tersedia.</div>
                        @endif
                    </div>
                    <div class="mb-5">
                        <h2 class="section-title text-center" data-aos="fade-up">Misi</h2>
                        @if($misi)
                        <div class="card border-0 shadow-sm h-100" data-aos="fade-up" data-aos-delay="120">
                            <div class="card-body">
                                    <div class="content-view">
                                        {!! $misi->content !!}
                                    </div>
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