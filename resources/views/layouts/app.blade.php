<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="d-flex">
            <!-- Sidebar -->
            <nav class="flex-column flex-shrink-0 p-3 bg-dark text-white vh-100" style="width: 250px;">
                <a href="/" class="d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-4">Admin Panel</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white" aria-current="page">
                            <i class="bi bi-house-door-fill me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/townships')}}" class="nav-link text-white {{ request()->is('admin/townships*') ? 'active' : '' }}">
                            <i class="bi bi-geo-alt-fill me-2"></i>
                            Townships
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/bus-lines')}}" class="nav-link text-white {{ request()->is('admin/bus-lines*') ? 'active' : '' }}">
                            <i class="bi bi-bus-front me-2"></i>
                            Bus Lines
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/bus-stops')}}" class="nav-link text-white {{ request()->is('admin/bus-stops*') ? 'active' : '' }}">
                            <i class="bi bi-sign-stop-fill me-2"></i>
                            Bus Stops
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/bus-routes')}}" class="nav-link text-white">
                            <i class="bi bi-sign-turn-right-fill me-2"></i>
                            Bus Routes
                        </a>
                    </li>
                </ul>
                <hr>
            </nav>

            <!-- Main Content -->
            <div class="flex-grow-1 p-3">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function () {
            let alert = document.getElementById('alert-success');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 300);
            }
        }, 3000);
    </script>
    @stack('scripts')
</body>
</html>
