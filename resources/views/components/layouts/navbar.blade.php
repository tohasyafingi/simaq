<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="javascript:void(0)" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ Auth::user()->img ? asset('storage/' . Auth::user()->img) : asset('assets/default-image.webp') }}"
                        class="user-image rounded-circle" alt="{{ Auth::user()->name }}" />
                    <span class="d-none d-md-inline">
                        {{ Auth::user()->name }}
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <img src="{{ Auth::user()->img ? asset('storage/' . Auth::user()->img) : asset('assets/default-image.webp') }}"
                            class="rounded-circle" alt="{{ Auth::user()->name }}" />
                        <p>
                            {{ Auth::user()->name }} - {{ Auth::user()->role }}
                            <small>Member since {{ Auth::user()->created_at->format('M Y') }}</small>
                        </p>
                    </li>
                    <li class="user-footer">
                        <a wire:navigate href="{{route('profil.show')}}" class="btn btn-sm btn-success">
                            <i class="bi bi-person-fill"></i>
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="d-inline float-end">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>