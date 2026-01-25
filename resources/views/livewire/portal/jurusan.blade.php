<div>
    <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
        <div class="container text-center">
            <h1 data-aos="fade-down" data-aos-duration="800">Program Jurusan</h1>
        </div>
    </section>

    <section class="section" data-aos="fade-up" data-aos-duration="800">
        <div class="container">
            <div class="row">

                @forelse($jurusans as $jurusan)
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="120">
                    <div class="card h-100">
                        @if($jurusan->image)
                        <img src="{{ asset('storage/'.$jurusan->image) }}" class="card-img-top" alt="{{ $jurusan->judul }}" loading="lazy" data-aos="zoom-in">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $jurusan->judul }}</h5>
                            <div class="card-text">
                                {!! $jurusan->content !!}
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-warning text-center">
                    Konten jurusan belum tersedia.
                </div>
                @endforelse

            </div>
        </div>
    </section>
</div>