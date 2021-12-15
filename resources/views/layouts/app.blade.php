<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    @livewireStyles
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="/"><img src="/images/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item">
                            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('setting') }}" class='sidebar-link'>
                                <i class="fas fa-cogs"></i>
                                <span>Setting</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('department') }}" class='sidebar-link'>
                                <i class="fas fa-building"></i>
                                <span>Department</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('users') }}" class='sidebar-link'>
                                <i class="fas fa-users"></i>
                                <span>Users</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i class="bi bi-x"></i></button>
            </div>
        </div>
        <div id="main" class='layout-navbar'>
            <!-- Toaster -->
            <div class="toast fixed-top mx-auto" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header" id="toaster_symbol">
                    <i class="fas fa-exclamation-circle me-1 text-white"></i>
                    <strong class="me-auto text-white" id="toaster_tittle"> Judul Snack Toaster</strong>
                </div>
                <div class="toast-body" id="toaster_message">
                    Delicioso Snack Toaster With Chocolato.
                </div>
            </div>
            <!-- Header -->
            <header class='mb-3'>
                <nav class="navbar navbar-expand navbar-light ">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown me-3">
                                    <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="far fa-bell fs-4 text-gray-600"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <h6 class="dropdown-header">Notifications</h6>
                                        </li>
                                        <li><a class="dropdown-item">No notification available</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">{{ Auth::user()->name }}</h6>
                                            <p class="mb-0 text-sm text-success">Role</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="{{ asset('/images/faces/0.jpg') }}">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">Hello, {{ strtok(Auth::user()->name, " ") }}!</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i
                                                class="icon-mid me-2 fas fa-user-cog"></i></i>My Password</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="icon-mid fas fa-sign-out-alt me-2"></i>
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="main pe-4 ps-1">
                <div class="page-heading">
                    <div class="page-title">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <!-- <script src="{{ mix('js/app.js') }}"></script> -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>\
    <!-- <script src="{{ asset('/js/bootstrap-select.min.js') }}"></script> -->
    <script src="{{ asset('/js/main.js') }}"></script>
    @livewireScripts
    @stack('scripts')
    <script>
    window.addEventListener('closemodal', event => {
        $(event.detail.modalid).modal('hide')
    });
    window.addEventListener('openmodal', event => {
        $(event.detail.modalid).modal('show')
    });
    window.addEventListener('toaster', event => {
        document.getElementById("toaster_message").innerHTML = event.detail.message;
        document.getElementById("toaster_symbol").style.backgroundColor = event.detail.color;
        document.getElementById("toaster_tittle").innerHTML = event.detail.title;
        let myAlert = document.querySelector('.toast');
        let bsAlert = new bootstrap.Toast(myAlert);
        bsAlert.show();
    });
    </script>
</body>

</html>