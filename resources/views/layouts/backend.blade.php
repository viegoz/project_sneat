<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                    <i class="bx bx-menu bx-sm"></i>
                </a>
            </div>
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                <!-- Search -->
                <div class="navbar-nav align-items-center">
                    <div class="nav-item d-flex align-items-center">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2" placeholder="Search..." />
                    </div>
                </div>
                <!-- /Search -->
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <!-- Language -->
                    <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <i class='bx bx-globe bx-sm'></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);" data-language="en" data-text-direction="ltr"><span class="align-middle">English</span></a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" data-language="fr" data-text-direction="ltr"><span class="align-middle">French</span></a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" data-language="ar" data-text-direction="rtl"><span class="align-middle">Arabic</span></a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" data-language="de" data-text-direction="ltr"><span class="align-middle">German</span></a></li>
                        </ul>
                    </li>
                    <!-- /Language -->
                    <!-- User -->
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <div class="avatar avatar-online">
                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="pages-account-settings-account.html">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <span class="fw-medium d-block">{{ Auth::user()->name }}</span>
                                            <small class="text-muted">{{ Auth::user()->roles->value('name') }}</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li><a class="dropdown-item" href=""><i class="bx bx-user me-2"></i><span class="align-middle">My Profile</span></a></li>
                            <li><a class="dropdown-item" href=""><i class="bx bx-cog me-2"></i><span class="align-middle">Settings</span></a></li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li><a class="dropdown-item" href=""><i class="bx bx-help-circle me-2"></i><span class="align-middle">FAQ</span></a></li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="" onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="bx bx-power-off me-2"></i>
                                        <span class="align-middle">Log Out</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!--/ User -->
                </ul>
            </div>
            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper d-none">
                <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search...">
                <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
            </div>
        </nav>
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('/') }}" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        {{-- Logo Here --}}
                    </span>
                    <span class="app-brand-text demo menu-text fw-bold ms-2">Sneat</span>
                </a>
                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="align-middle bx bx-chevron-left bx-sm"></i>
                </a>
            </div>
            <div class="menu-inner-shadow"></div>
            <ul class="py-1 menu-inner">
                <li class="menu-item {{ request()->is('home') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Beranda">Beranda</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('home/entry') ? 'active' : '' }}">
                            <a href="{{ route('home.entry') }}" class="menu-link">
                                <div data-i18n="Entry">Entry</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('home/update') ? 'active' : '' }}">
                            <a href="{{ route('home.update') }}" class="menu-link">
                                <div data-i18n="Update">Update</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('home/monitoring') ? 'active' : '' }}">
                            <a href="{{ route('home.monitoring') }}" class="menu-link">
                                <div data-i18n="Monitoring">Monitoring</div>
                            </a>
                        </li>
                    </ul>
                </li>
                @role('Administrator')
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Users Management</span>
                    </li>
                    <li class="menu-item {{ request()->is('users') ? 'open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-layout"></i>
                            <div data-i18n="Kelola Pengguna">Kelola Pengguna</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ request()->is('users') ? 'active' : '' }}">
                                <a href="{{ route('users.index') }}" class="menu-link">
                                    <div data-i18n="Pengguna">Pengguna</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">System Management</span>
                    </li>
                    <li class="menu-item {{ request()->is('settings') ? 'open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-layout"></i>
                            <div data-i18n="Pengaturan Sistem">Pengaturan Sistem</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="" class="menu-link">
                                    <div data-i18n="Pengaturan">Pengaturan</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endrole
            </ul>
        </aside>
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
