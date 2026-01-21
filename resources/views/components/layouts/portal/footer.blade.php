<footer>
    <div class="container">
        <div class="row">

            <div class="col-md-3 mb-4">
                <h5>Tentang Kami</h5>
                <p>
                    {{ $kontak->about ?? 'Informasi belum tersedia.' }}
                </p>
            </div>

            <div class="col-md-3 mb-4">
                <h5>Contact Info</h5>

                <div class="d-flex align-items-start mb-2">
                    <i class="bi bi-geo-alt fs-5 me-3 "></i>
                    <span class="text-break">
                        {{ $kontak->alamat ?? '-' }}
                    </span>
                </div>

                <div class="d-flex align-items-start mb-2">
                    <i class="bi bi-telephone fs-5 me-3 "></i>
                    <span>
                        {{ $kontak->telepon ?? '-' }}
                    </span>
                </div>

                <div class="d-flex align-items-start">
                    <i class="bi bi-envelope fs-5 me-3 "></i>
                    <span class="text-break">
                        {{ $kontak->email ?? '-' }}
                    </span>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <h5>Quick Links</h5>
                <ul style="list-style: none; padding: 0">
                    <li><a href="{{ route('beranda') }}">Home</a></li>
                    <li><a href="{{ route('berita-agenda') }}">Berita</a></li>
                    <li><a href="{{ route('ppdb') }}">SPMB</a></li>
                    <li><a href="{{ route('kontak') }}">Contact</a></li>
                </ul>
            </div>

            <div class="col-md-3 mb-4">
                <h5>Follow Us</h5>
                <div class="social-links">
                    @if($kontak?->facebook)
                    <a href="{{ $kontak->facebook }}" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    @endif

                    @if($kontak?->twitter)
                    <a href="{{ $kontak->twitter }}" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    @endif

                    @if($kontak?->instagram)
                    <a href="{{ $kontak->instagram }}" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif

                    @if($kontak?->youtube)
                    <a href="{{ $kontak->youtube }}" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                    @endif
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <strong>
                Copyright &copy; {{ date('Y') }}&nbsp;
                <a href="{{ route('beranda') }}" class="text-decoration-none">MATAQ WSB </a>
            </strong>
            {{-- | Support by <a href="#" class="text-decoration-none"> @tohasyafingi</a> --}}
        </div>
    </div>
</footer>