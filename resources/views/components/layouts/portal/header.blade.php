<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container position-relative d-flex align-items-center justify-content-between">

    <a href="{{ route('beranda')}}" class="logo d-flex align-items-center me-auto me-xl-0">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <!-- <img src="assets/img/logo.webp" alt=""> -->
      <h1 class="sitename">SIMAQ</h1>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a wire:navigate href="{{ route('beranda')}}" class="active">Beranda</a></li>
        <li class="dropdown"><a href="#"><span>Profil</span><i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a wire:navigate href="{{route('sejarah')}}">Sejarah</a></li>
            <li><a wire:navigate href="{{route('visi-misi')}}">Visi & Misi</a></li>
            <li><a wire:navigate href="{{route('struktur-organisasi')}}">Struktur Organisasi</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#"><span>Akademik</span> <i
              class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a wire:navigate href="{{route('jurusan')}}">Program Jurusan</a></li>
            <li><a wire:navigate href="{{route('ekstrakurikuler')}}">Ekstrakurikuler</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#"><span>Kesiswaan</span> <i
              class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a wire:navigate href="{{route('osis')}}">OSIS</a></li>
            <li><a wire:navigate href="{{route('pramuka')}}">Pramuka</a></li>
            <li><a wire:navigate href="{{route('program-tahfidz')}}">Program Tahfidz</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#"><span>Informasi Publik</span> <i
              class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a wire:navigate href="{{route('berita-agenda')}}">Berita & Agenda</a></li>
            <li><a wire:navigate href="{{route('karya-ilmiah')}}">Karya Ilmiah</a></li>
            <li><a wire:navigate href="{{route('artikel')}}">E-Book</a></li>
            <li><a wire:navigate href="{{route('download')}}">Download</a></li>
          </ul>
        </li>
        <li><a wire:navigate href="{{route('galeri')}}">Galeri</a></li>
        <li><a wire:navigate href="{{route('ppdb')}}">PPDB</a></li>
        <li><a wire:navigate href="{{route('kontak')}}">Kontak</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    @guest
      {{-- Kalau belum login --}}
      <a class="btn-getstarted" wire:navigate href="{{ route('login') }}">Login</a>
    @endguest

    @auth
      {{-- Kalau sudah login, arahkan sesuai role --}}
      @php
        $roleRoutes = [
          'admin' => 'superadmin.admin.dashboard',
          'guru' => 'superadmin.guru.dashboard',
          'siswa' => 'siswa.dashboard',
          'karyawan' => 'karyawan.dashboard',
          'bendahara' => 'bendahara.dashboard',
          'alumni' => 'alumni.dashboard',
        ];

        $userRole = Auth::user()->role;
        $dashboardRoute = $roleRoutes[$userRole] ?? null;
      @endphp

      @if ($dashboardRoute && Route::has($dashboardRoute))
        <a class="btn-getstarted" wire:navigate href="{{ route($dashboardRoute) }}">
          Dashboard
        </a>
      @else
        {{-- fallback kalau role tidak dikenali --}}
        <a class="btn-getstarted" wire:navigate href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      @endif
    @endauth

  </div>
</header>