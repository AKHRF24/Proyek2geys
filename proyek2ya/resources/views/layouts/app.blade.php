<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Market Point') }}</title>

    <!-- Fonts and Icons -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <i class="bi bi-shop me-2"></i>
                    {{ config('app.name', 'Market Point') }}
                </a>

                <!-- Mobile Toggle -->
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarContent" aria-controls="navbarContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <!-- Right Side Navigation -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <div class="d-flex gap-2">
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="btn btn-outline-light" href="{{ route('login') }}">
                                            <i class="bi bi-box-arrow-in-right me-1"></i>
                                            {{ __('Login') }}
                                        </a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="btn btn-light" href="{{ route('register') }}">
                                            <i class="bi bi-person-plus me-1"></i>
                                            {{ __('Register') }}
                                        </a>
                                    </li>
                                @endif
                            </div>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                   id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random"
                                         class="rounded-circle me-2" alt="Profile" width="32" height="32">
                                    {{ Auth::user()->name }}
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end shadow-sm"
                                    aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ url('/profile') }}">
                                            <i class="bi bi-person me-2"></i>Profile
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right me-2"></i>
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}"
                                              method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
