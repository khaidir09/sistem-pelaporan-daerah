<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sepeda.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-sepeda.png')}}" alt="" height="24">
                    </span>
                </a>
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sepeda.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-sepeda.png')}}" alt="" height="24">
                    </span>
                </a>
            </div>

 <ul id="side-menu">
 
    <li class="menu-title">Menu</li>

    <li>
        <a href="{{ route('dashboard') }}" class="tp-link">
            <i data-feather="home"></i>
            <span> Dashboard </span>
        </a>
    </li>
    @if (Auth::user()->hasRole('User'))
        <li>
            <a href="{{ route('laporan.index') }}" class="tp-link">
                <i data-feather="home"></i>
                <span> Laporan </span>
            </a>
        </li>
    @endif
    @if (Auth::user()->hasRole('Super Admin'))
        <li class="{{ Request::is('master*') ? 'menuitem-active' : '' }}">
            <a href="#Master" data-bs-toggle="collapse" class="{{ Request::is('master*') ? '' : 'collapsed' }}" aria-expanded="{{ Request::is('master*') ? 'true' : 'false' }}">
                <i data-feather="users"></i>
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
                </ul>
            </div>
        </li>

        
        

        <li class="menu-title mt-2">General</li>

        <li>
            <a href="#sidebarBaseui" data-bs-toggle="collapse">
                <i data-feather="package"></i>
                <span> Role & Permission </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarBaseui">
    <ul class="nav-second-level">
        <li>
            <a href="{{ route('all.permission') }}" class="tp-link">All Permission</a>
        </li>
        <li>
            <a href="{{ route('all.roles') }}" class="tp-link">All Roles</a>
        </li>

        <li>
            <a href="{{ route('add.roles.permission') }}" class="tp-link">Role In Permission</a>
        </li>
        <li>
            <a href="{{ route('all.roles.permission') }}" class="tp-link">All Role Permission</a>
        </li>
        
    </ul>
            </div>
        </li>


        <li>
            <a href="#sidebarBaseui" data-bs-toggle="collapse">
                <i data-feather="package"></i>
                <span> Manage Admin </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarBaseui">
    <ul class="nav-second-level">
        <li>
            <a href="{{ route('all.admin') }}" class="tp-link">All Admin</a>
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