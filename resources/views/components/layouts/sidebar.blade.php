<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('superadmin.admin.dashboard') }}" class="brand-link logo-switch">
            <!--begin::Brand Image Small-->
            <img src="{{asset('adminlte/dist/assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo Small"
                class="brand-image-xl logo-xs opacity-75 shadow" />
            <!--end::Brand Image Small-->
            <!--begin::Brand Image Large-->
            <img src="{{asset('adminlte/dist/assets/img/AdminLTEFullLogo.png')}}" alt="AdminLTE Logo Large"
                class="brand-image-xs logo-xl opacity-75" />
            <!--end::Brand Image Large-->
        </a>
        <!--end::Brand Link-->
    </div>
    {{-- <div class="sidebar-brand">
        <a href="{{ route('superadmin.admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/logo2.webp') }}" alt="SIMAQ" class="brand-image opacity-75" />
            <span class="brand-text fw-light">SIMAQ</span>
        </a>
    </div> --}}
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a wire:navigate href="{{ route('superadmin.admin.dashboard') }}"
                        class="nav-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!-- DATA -->
                <li class="nav-header">DATA</li>
                <!-- MASTER DATA -->
                <li
                    class="nav-item {{ Request::is('admin/data-siswa*') || Request::is('admin/data-guru*') || Request::is('admin/data-bendahara*') || Request::is('admin/data-tata-usaha*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            MASTER DATA
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.siswa.index')}}"
                                class="nav-link {{ Request::is('admin/data-siswa*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.guru.index')}}"
                                class="nav-link {{ Request::is('admin/data-guru*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Guru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.bendahara.index')}}"
                                class="nav-link {{ Request::is('admin/data-bendahara*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Bendahara</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.tata-usaha.index')}}"
                                class="nav-link {{ Request::is('admin/data-tata-usaha*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Tata Usaha</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- E-LEARNING -->
                <li class="nav-header">E-LEARNING</li>

                <li
                    class="nav-item {{ Request::is('admin/tahun-ajaran*') || Request::is('admin/jurusan*') || Request::is('admin/tingkat-kelas*') || Request::is('admin/ruang-kelas*') || Request::is('admin/mata-pelajaran*') || Request::is('admin/jam-pelajaran*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fas fa-school"></i>
                        <p>
                            MASTER LEARNING
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.tahun-ajaran.index')}}"
                                class="nav-link {{ Request::is('admin/tahun-ajaran*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Tahun Ajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.tingkat-kelas.index')}}"
                                class="nav-link {{ Request::is('admin/tingkat-kelas*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Tingkat Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.jurusan.index')}}"
                                class="nav-link {{ Request::is('admin/jurusan*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Jurusan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.ruang-kelas.index')}}"
                                class="nav-link {{ Request::is('admin/ruang-kelas*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Ruang Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.jam-pelajaran.index')}}"
                                class="nav-link {{ Request::is('admin/jam-pelajaran*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Jam Pelajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.pelajaran.index')}}"
                                class="nav-link {{ Request::is('admin/mata-pelajaran*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Mata Pelajaran</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ Request::is('admin/pengajar*') || Request::is('admin/modul-pelajaran*') || Request::is('admin/rombel*') || Request::is('admin/jadwal*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            E-LEARNING
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.pengajar.index')}}"
                                class="nav-link {{ Request::is('admin/pengajar*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Pengajar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.modul.index')}}"
                                class="nav-link {{ Request::is('admin/modul-pelajaran*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Modul Pelajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.rombel.index')}}"
                                class="nav-link {{ Request::is('admin/rombel*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Rombel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.jadwal.index')}}"
                                class="nav-link {{ Request::is('admin/jadwal*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Jadwal</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- GURU -->
                <li class="nav-header">GURU</li>
                <li
                    class="nav-item {{ Request::is('admin/guru-pengajar*') || Request::is('admin/guru-modul*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            E-LEARNING GURU
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.guru-pengajar.index')}}"
                                class="nav-link {{ Request::is('admin/guru-pengajar*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Mata Pelajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{route('superadmin.admin.guru-modul.index')}}"
                                class="nav-link {{ Request::is('admin/guru-modul*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Modul Pelajaran</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- WEBSITE -->
                <li class="nav-header">WEBSITE</li>
                <!-- KONTEN -->
                <li
                    class="nav-item {{ Request::is('admin/berita*') || Request::is('admin/kategori-berita*') || Request::is('admin/karya-ilmiah*') || Request::is('admin/kategori-karya-ilmiah*') || Request::is('admin/e-book*') || Request::is('admin/download*') || Request::is('admin/galeri*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fas fa-window-restore"></i>
                        <p>
                            KONTEN
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li
                            class="nav-item {{ Request::is('admin/berita*') || Request::is('admin/kategori-berita*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Berita
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a wire:navigate href="{{ route('superadmin.admin.berita.index')}}"
                                        class="nav-link {{ Request::is('admin/berita*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Daftar Berita</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a wire:navigate href="{{ route('superadmin.admin.kat-berita.index')}}"
                                        class="nav-link {{ Request::is('admin/kategori-berita*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Kategori</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="nav-item {{ Request::is('admin/karya-ilmiah*') || Request::is('admin/kategori-karya-ilmiah*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Karya Ilmiah
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a wire:navigate href="{{ route('superadmin.admin.karya-ilmiah.index')}}"
                                        class="nav-link {{ Request::is('admin/karya-ilmiah*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Daftar Karya Ilmiah</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a wire:navigate href="{{ route('superadmin.admin.kat-karya-ilmiah.index')}}"
                                        class="nav-link {{ Request::is('admin/kategori-karya-ilmiah*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Kategori</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{ route('superadmin.admin.e-book.index')}}"
                                class="nav-link {{ Request::is('admin/e-book*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>E-book</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{ route('superadmin.admin.download.index')}}"
                                class="nav-link {{ Request::is('admin/download*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Download</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{ route('superadmin.admin.galeri.index')}}"
                                class="nav-link {{ Request::is('admin/galeri*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Galeri</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- WEBSITE -->
                <li
                    class="nav-item {{ Request::is('admin/profil*') || Request::is('admin/akademik*') || Request::is('admin/kesiswaan*') || Request::is('admin/ppdb*') || Request::is('admin/kontak*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fas fa-desktop"></i>
                        <p>
                            DATA WEBSITE
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a wire:navigate href="{{ route('superadmin.admin.profil.index')}}"
                                class="nav-link {{ Request::is('admin/profil*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Profil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{ route('superadmin.admin.akademik.index')}}"
                                class="nav-link {{ Request::is('admin/akademik*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Akademik</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{ route('superadmin.admin.kesiswaan.index')}}"
                                class="nav-link {{ Request::is('admin/kesiswaan*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Kesiswaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{ route('superadmin.admin.ppdb.index')}}"
                                class="nav-link {{ Request::is('admin/ppdb*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>PPDB</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate href="{{ route('superadmin.admin.kontak.index')}}"
                                class="nav-link {{ Request::is('admin/kontak*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Kontak</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Setting -->
                <li class="nav-header">SETTING</li>
                <li class="nav-item">
                    <a wire:navigate href="{{route('superadmin.admin.user.index')}}"
                        class="nav-link {{ Request::is('admin/data-user*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Manajemen User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('beranda')}}" target="_blank" class="nav-link">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>
                            Go to Website
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>

                    <!-- Form logout -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>