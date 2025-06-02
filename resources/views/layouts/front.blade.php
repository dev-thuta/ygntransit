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
                                မူလစာမျက်နှာ
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
                        <li>
                            <a href="{{ url('/guide')}}" class="nav-link {{ request()->is('guide*') ? 'active' : '' }}">
                                အသုံးပြုနည်း
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
    <footer class="bg-light text-dark shadow pt-4 pb-3 mt-5">
    <div class="container">
        <div class="row text-start">
            <!-- About -->
            <div class="col-md-4 mb-3">
                <h6 class="fw-bold">YGN Transit</h6>
                <p class="small">
                    ရန်ကုန်မြို့တွင်း ဘတ်စ်ကားလမ်းကြောင်းများ၊ မှတ်တိုင်များနှင့် ခရီးစဉ်များကို လွယ်ကူစွာ ရှာဖွေနိုင်သောဝက်ဘ်ဆိုက်။
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 mb-3">
                <h6 class="fw-bold">အမြန်လင့်များ</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ url('/home') }}" class="text-decoration-none text-dark">မူလစာမျက်နှာ</a></li>
                    <li><a href="{{ url('/bus-lines') }}" class="text-decoration-none text-dark">ဘတ်စ်ကားလိုင်းများ</a></li>
                    <li><a href="{{ url('/bus-stops') }}" class="text-decoration-none text-dark">မှတ်တိုင်များ</a></li>
                    <li><a href="{{ url('/bus-routes') }}" class="text-decoration-none text-dark">လမ်းကြောင်းများ</a></li>
                    <li><a href="{{ url('/guide') }}" class="text-decoration-none text-dark">အသုံးပြုနည်း</a></li>
                </ul>
            </div>

            <!-- Contact or Info -->
            <div class="col-md-4 mb-3">
                <h6 class="fw-bold">ဆက်သွယ်ရန်</h6>
                <p class="small mb-1">အကြံပြုချက်များရှိပါက ကျွန်ုပ်တို့ထံ ဆက်သွယ်ပါ။</p>
                <p class="small mb-0">
                    <i class="bi bi-envelope-fill me-1"></i>
                    <a href="mailto:devthuta@icloud.com" class="text-decoration-none text-dark">devthuta@icloud.com</a>
                </p>
            </div>
        </div>

        <hr>

        <div class="text-center small text-muted">
            &copy; {{ date('Y') }} {{ config('app.name', 'YGN Transit') }}. All rights reserved.
        </div>
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
