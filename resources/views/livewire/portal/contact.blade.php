<div>
    <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
        <div class="container text-center">
            <h1>Kontak Kami</h1>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title">Informasi Kontak</h2>

            @if($kontak)
            <div class="row mb-5">
                <div class="col-lg-4 mb-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                            <h5 class="card-title">Alamat</h5>
                            <p class="card-text">{!! nl2br(e($kontak->alamat)) !!}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                            <h5 class="card-title">Telepon</h5>
                            <p class="card-text">{!! nl2br(e($kontak->telepon)) !!}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                            <h5 class="card-title">Email</h5>
                            <p class="card-text">
                                @if($kontak->email)
                                @foreach(explode("\n", $kontak->email) as $email)
                                <a href="mailto:{{ trim($email) }}" style="color: inherit; text-decoration: none;">{{ trim($email) }}</a><br>
                                @endforeach
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="section-title text-center mb-5">Kontak & Lokasi</h2>

            <div class="row mb-5 align-items-stretch">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm h-100" style="height: 350px;">
                        <div class="card-body p-0 h-100">
                            {!! $kontak->google_map_embed ?? '<p class="text-center my-3">Peta belum tersedia</p>' !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm h-100" style="height: 350px;">
                        <div class="card-body">
                            <form wire:submit.prevent="sendMessage">
                                <div class="mb-2">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-sm" id="name" placeholder="Nama lengkap Anda" required>
                                </div>

                                <div class="mb-2">
                                    <label for="email" class="form-label">Alamat Email</label>
                                    <input type="email" class="form-control form-control-sm" id="email" placeholder="alamat.email@contoh.com" required>
                                </div>

                                <div class="mb-2">
                                    <label for="subject" class="form-label">Subjek</label>
                                    <input type="text" class="form-control form-control-sm" id="subject" placeholder="Subjek pesan" required>
                                </div>

                                <div class="mb-2">
                                    <label for="message" class="form-label">Pesan</label>
                                    <textarea class="form-control form-control-sm" id="message" rows="3" placeholder="Pesan Anda di sini..." required></textarea>
                                </div>

                                <div class="text-center mt-2">
                                    <!-- <button type="submit" class="btn btn-primary btn-sm">Kirim Pesan</button> -->
                                    <button type="button" class="btn btn-primary btn-sm">Kirim Pesan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @else
            <div class="alert alert-warning text-center">
                Konten kontak belum tersedia.
            </div>
            @endif
        </div>
    </section>
</div>