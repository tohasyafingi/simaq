<div>
    <!-- ===== Banner Section Start ===== -->
    <section class="hero-section" style="height: 200px;">
        <div class="hero-content text-center">
            <h1>Program Jurusan</h1>
        </div>
    </section>
    <!-- ===== Banner Section End ===== -->

    <!-- ===== Content Section Start ===== -->
    <section class="section">
        <div class="container">
            <div class="row">

                @forelse($jurusans as $jurusan)
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        @if($jurusan->image)
                        <img src="{{ asset('storage/'.$jurusan->image) }}" class="card-img-top" alt="{{ $jurusan->judul }}">
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
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Konten jurusan belum tersedia.
                    </div>
                </div>
                @endforelse

            </div>
        </div>
    </section>
    <!-- ===== Content Section End ===== -->
</div>
