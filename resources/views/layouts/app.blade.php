<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/public/img/icon.png') }}" rel="icon">
    <link href="{{ asset('assets/public/img/icon.png') }}" rel="apple-touch-icon">
    @extends('layouts.css')
</head>

<body class="index-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="{{ route('public.home') }}" class="logo d-flex align-items-center me-auto" style="text-decoration: none;">
                <img src="{{ asset('assets/public/img/icon.png') }}" class="img-fluid animated" alt="" style="width: 70px; height: 200px;">
                <h1 class="sitename" style="font-size: 15px;">International <br>Ecsis <br>Association</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li id="home-link" class="{{ request()->routeIs('public.home') ? 'active' : '' }}">
                        <a href="{{ route('public.home') }}">Home</a>
                    </li>
                    <li class="dropdown dropdown {{ request()->routeIs('public.training') || request()->routeIs('public.digitalservice') ? 'active' : '' }}">
                        <a href="javascript:void(0)" class="dropbtn">Service <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <div class="dropdown-content">
                            <a href="{{ route('public.training') }}" class="{{ request()->routeIs('public.training') ? 'active' : 'inactive' }}">Training</a>
                            <a href="{{ route('public.digitalservice') }}" class="{{ request()->routeIs('public.digitalservice') ? 'active' : 'inactive' }}">Digital Service</a>
                        </div>
                    </li>
                    <li id="editorial-team-link" class="{{ request()->routeIs('public.editor') ? 'active' : '' }}">
                        <a href="{{ route('public.editor') }}">Editorial Team</a>
                    </li>
                    <li id="econtact-link" class="{{ request()->routeIs('public.contact') ? 'active' : '' }}">
                        <a href="{{ route('public.contact') }}">Contact</a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>


        </div>
    </header>
    @yield('content')
    @extends('layouts.footer')
</body>