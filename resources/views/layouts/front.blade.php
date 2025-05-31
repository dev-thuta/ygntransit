<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', config('app.name', 'Laravel'))
    </title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        {{-- Navbar --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('images/YGN-Transit-brand.png') }}" alt="YGN Transit" style="height: 64px;">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav ms-auto">
                        <li>
                            <a href="{{ url('/home')}}" class="nav-link {{ request()->is('home*') ? 'active' : '' }}">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/bus-lines')}}" class="nav-link {{ request()->is('bus-lines*') ? 'active' : '' }}">
                                ဘတ်စ်
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/bus-stops')}}" class="nav-link {{ request()->is('bus-stops*') ? 'active' : '' }}">
                                မှတ်တိုင်
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/bus-routes')}}" class="nav-link {{ request()->is('bus-routes*') ? 'active' : '' }}">
                                လမ်းကြောင်း
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Main Content --}}
        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
    {{-- footer --}}
    <footer class="bg-light text-dark shadow text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
        </div>
    </footer>
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
