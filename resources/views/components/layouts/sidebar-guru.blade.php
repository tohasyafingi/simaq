{{-- SIDEBAR UNTUK GURU --}}
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="#" class="brand-link">
            <img src="{{ asset('adminlte/dist/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75" />
            <span class="brand-text fw-light">AdminLTE 4</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a wire:navigate href="{{ route('superadmin.guru.dashboard') }}" class="nav-link {{ Request::is('guru/dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">E-LEARNING</li>
                <li class="nav-item">
                    <a wire:navigate href="{{route('superadmin.guru.pelajaran.index')}}" class="nav-link {{ Request::is('guru/mata-pelajaran*') ? 'active' : '' }}">
                        <p><i class="fas fa-user-graduate"></i>
                            Mata Pelajaran
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a wire:navigate href="{{route('superadmin.guru.modul.index')}}" class="nav-link {{ Request::is('guru/modul-pelajaran*') ? 'active' : '' }}">
                        <p><i class="fas fa-user-graduate"></i>
                            Modul Pelajaran
                        </p>
                    </a>
                </li>
                <!-- Setting -->
                <li class="nav-header">SETTING</li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>