<nav class="navbar navbar-expand-lg navbar-green sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('beranda')}}">
      <i class="bi bi-mortarboard-fill me-2"></i>High School
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('beranda')}}">Home</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Profile
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('sejarah')}}">History</a></li>
            <li><a class="dropdown-item" href="{{route('visi-misi')}}">Vision & Mission</a></li>
            <li><a class="dropdown-item" href="{{route('struktur-organisasi')}}">Organizational Structure</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Academic
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('jurusan')}}">Study Programs</a></li>
            <li><a class="dropdown-item" href="{{route('ekstrakurikuler')}}">Extracurricular</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Student Affairs
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('osis')}}">Student Council</a></li>
            <li><a class="dropdown-item" href="{{route('pramuka')}}">Scouts</a></li>
            <li><a class="dropdown-item" href="{{route('program-tahfidz')}}">Tahfidz Program</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Public Information
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('berita-agenda')}}">News</a></li>
            <li><a class="dropdown-item" href="{{route('karya-ilmiah')}}">Scientific Works</a></li>
            <li><a class="dropdown-item" href="{{route('artikel')}}">E-Book</a></li>
            <li><a class="dropdown-item" href="{{route('download')}}">Download</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('galeri')}}">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('ppdb')}}">PPDB</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('kontak')}}">Contact</a>
        </li>
      </ul>

      @guest
        <a wire:navigate href="{{ route('login') }}" class="btn btn-light login-btn">Login</a>
      @endguest

      @auth
        @php
          $roleRoutes = [
            'admin' => 'superadmin.admin.dashboard',
            'guru' => 'superadmin.guru.dashboard',
            'siswa' => 'superadmin.siswa.dashboard',
            'karyawan' => 'karyawan.dashboard',
            'bendahara' => 'bendahara.dashboard',
            'alumni' => 'alumni.dashboard',
          ];
          $userRole = Auth::user()->role;
          $dashboardRoute = $roleRoutes[$userRole] ?? null;
        @endphp

        @if ($dashboardRoute && Route::has($dashboardRoute))
          <a class="btn btn-outline-light ms-2" wire:navigate href="{{ route($dashboardRoute) }}">
            Dashboard
          </a>
        @else
          <a class="btn btn-outline-light ms-2" wire:navigate href="{{ route('logout') }}"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        @endif
      @endauth
    </div>
  </div>
</nav>
