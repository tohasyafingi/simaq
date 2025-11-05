<nav class="navbar navbar-expand-lg navbar-light sticky-top">
  <div class="container">
    <a class="navbar-brand" href="{{ route('beranda') }}">
      <i class="fas fa-school"></i> SMA School
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <!-- Home -->
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" wire:navigate
            href="{{ route('beranda') }}">Home</a>
        </li>

        <!-- Profile -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ request()->routeIs('sejarah', 'visi-misi', 'struktur-organisasi') ? 'active' : '' }}"
            href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Profile
          </a>
          <ul class="dropdown-menu" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item {{ request()->routeIs('sejarah') ? 'active' : '' }}" wire:navigate
                href="{{ route('sejarah') }}">History</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('visi-misi') ? 'active' : '' }}" wire:navigate
                href="{{ route('visi-misi') }}">Vision & Mission</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('struktur-organisasi') ? 'active' : '' }}" wire:navigate
                href="{{ route('struktur-organisasi') }}">Organizational Structure</a></li>
          </ul>
        </li>

        <!-- Academic -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ request()->routeIs('jurusan', 'ekstrakurikuler') ? 'active' : '' }}"
            href="#" id="academicDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Academic
          </a>
          <ul class="dropdown-menu" aria-labelledby="academicDropdown">
            <li><a class="dropdown-item {{ request()->routeIs('jurusan') ? 'active' : '' }}" wire:navigate
                href="{{ route('jurusan') }}">Study Programs</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('ekstrakurikuler') ? 'active' : '' }}" wire:navigate
                href="{{ route('ekstrakurikuler') }}">Extracurricular</a></li>
          </ul>
        </li>

        <!-- Student Affairs -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ request()->routeIs('osis', 'pramuka', 'program-tahfidz') ? 'active' : '' }}"
            href="#" id="studentAffairsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Student Affairs
          </a>
          <ul class="dropdown-menu" aria-labelledby="studentAffairsDropdown">
            <li><a class="dropdown-item {{ request()->routeIs('osis') ? 'active' : '' }}" wire:navigate
                href="{{ route('osis') }}">Student Council</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('pramuka') ? 'active' : '' }}" wire:navigate
                href="{{ route('pramuka') }}">Scouts</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('program-tahfidz') ? 'active' : '' }}" wire:navigate
                href="{{ route('program-tahfidz') }}">Tahfidz Program</a></li>
          </ul>
        </li>

        <!-- Public Information -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ request()->routeIs('berita-agenda', 'karya-ilmiah', 'artikel', 'download') ? 'active' : '' }}"
            href="#" id="publicInfoDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Public Information
          </a>
          <ul class="dropdown-menu" aria-labelledby="publicInfoDropdown">
            <li><a class="dropdown-item {{ request()->routeIs('berita-agenda') ? 'active' : '' }}" wire:navigate
                href="{{ route('berita-agenda') }}">News</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('karya-ilmiah') ? 'active' : '' }}" wire:navigate
                href="{{ route('karya-ilmiah') }}">Scientific Works</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('artikel') ? 'active' : '' }}" wire:navigate
                href="{{ route('artikel') }}">E-Book</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('download') ? 'active' : '' }}" wire:navigate
                href="{{ route('download') }}">Download</a></li>
          </ul>
        </li>

        <!-- Gallery -->
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}" wire:navigate
            href="{{ route('galeri') }}">Gallery</a>
        </li>

        <!-- Admission -->
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('ppdb') ? 'active' : '' }}" wire:navigate
            href="{{ route('ppdb') }}">Admission (PPDB)</a>
        </li>

        <!-- Contact -->
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" wire:navigate
            href="{{ route('kontak') }}">Contact</a>
        </li>

        <!-- Auth Buttons -->
        <li class="nav-item">
          @guest
            <a wire:navigate href="{{ route('login') }}" class="btn btn-login">Login</a>
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
              $user = Auth::user();
              $userRole = $user->role ?? null;
              $dashboardRoute = $roleRoutes[$userRole] ?? null;
            @endphp

            @if ($dashboardRoute && Route::has($dashboardRoute))
              <a class="btn btn-outline-light ms-2" wire:navigate href="{{ route($dashboardRoute) }}">Dashboard</a>
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
        </li>
      </ul>
    </div>
  </div>
</nav>