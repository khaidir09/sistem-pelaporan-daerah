<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/sepeda.png')}}" alt="" height="48">
                    </span>
                </a>
            </div>

            <ul id="side-menu" class="mt-2">
            
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="tp-link">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li class="{{ Request::is('laporan*') ? 'menuitem-active' : '' }}">
                    <a href="{{ route('laporan.index') }}" class="tp-link">
                        <i data-feather="file-text"></i>
                        <span> Laporan </span>
                    </a>
                </li>
                @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('APIP'))
                    <li class="{{ Request::is('riwayat-penilaian') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('riwayat-penilaian') }}" class="tp-link">
                            <i data-feather="activity"></i>
                            <span> Riwayat Penilaian</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasRole('Super Admin'))
                    <li class="{{ Request::is('master*') ? 'menuitem-active' : '' }}">
                        <a href="#Master" data-bs-toggle="collapse" class="{{ Request::is('master*') ? '' : 'collapsed' }}" aria-expanded="{{ Request::is('master*') ? 'true' : 'false' }}">
                            <i data-feather="database"></i>
                            <span>Data Master</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse {{ Request::is('master*') ? 'show' : '' }}" id="Master">
                            <ul class="nav-second-level">
                                <li class="{{ Request::is('master/urusan*') ? 'active' : '' }}">
                                    <a href="{{ route('urusan.index') }}" class="tp-link">Urusan</a>
                                </li>
                                <li class="{{ Request::is('master/outcome*') ? 'active' : '' }}">
                                    <a href="{{ route('outcome.index') }}" class="tp-link">IKK Outcome</a>
                                </li>
                                <li class="{{ Request::is('master/skpd*') ? 'active' : '' }}">
                                    <a href="{{ route('skpd.index') }}" class="tp-link">SKPD</a>
                                </li>
                                <li class="{{ Request::is('master/pengguna*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('all.admin') }}" class="tp-link">Manajemen Pengguna</a>
                                </li>
                                <li class="{{ Request::is('setting/system*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('system.setting.index') }}" class="tp-link">Pengaturan Sistem</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>