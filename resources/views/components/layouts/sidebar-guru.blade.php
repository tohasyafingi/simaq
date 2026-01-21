{{-- SIDEBAR UNTUK GURU --}}
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    {{-- <div class="sidebar-brand">
        <a href="{{ route('superadmin.admin.dashboard') }}" class="brand-link logo-switch">
            <img src="{{asset('adminlte/dist/assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo Small"
                class="brand-image-xl logo-xs opacity-75 shadow" />
            <img src="{{asset('adminlte/dist/assets/img/AdminLTEFullLogo.png')}}" alt="AdminLTE Logo Large"
                class="brand-image-xs logo-xl opacity-75" />
        </a>
    </div> --}}
    <div class="sidebar-brand">
        <a href="{{ route('superadmin.guru.dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/logo.webp') }}" alt="SIMAQ" class="brand-image" />
            <span class="brand-text fw-light">SIMAQ</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a wire:navigate href="{{ route('superadmin.guru.dashboard') }}" class="nav-link {{ Request::is('guru/dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">E-LEARNING</li>
                <li class="nav-item">
                    <a wire:navigate
                        href="{{ route('superadmin.guru.pelajaran.index', ['guruId' => auth()->user()->guru->id ?? auth()->id()]) }}"
                        class="nav-link {{ Request::is('guru/mata-pelajaran*') ? 'active' : '' }}">
                        <i class="fas fa-user-graduate"></i>
                        <p>Mata Pelajaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a wire:navigate
                        href="{{ route('superadmin.guru.modul.show', ['gurumodulId' => auth()->user()->guru->id ?? auth()->id()]) }}"
                        class="nav-link {{ Request::is('guru/modul-pelajaran*') ? 'active' : '' }}">
                        <i class="fas fa-book"></i>
                        <p>Modul Pelajaran</p>
                    </a>
                </li>
                <li class="nav-header">SETTING</li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>