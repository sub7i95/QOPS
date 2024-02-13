<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/images/logo.svg') }}" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8aea7295a5.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
            <div class="container-fluid">
                
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ url('/images/logo.svg') }}" alt="" title="" height="35">
            </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto text-uppercase fw-bold">
                        @guest
                        @else
                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link" href="{{ url('dashboard') }}" role="button" >
                                 Dashboard
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 New
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href=""> PureCloud </a>
                                    <a class="dropdown-item" href=""> ALL </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 Tickets
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('tickets') }}"> All </a>
                                    <a class="dropdown-item" href="{{ url('tickets/download') }}"> Download </a>
                                    <a class="dropdown-item" href="{{ url('tickets/upload') }}"> Upload  </a>
                                </div>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ url('surveys') }}">{{ __('Surveys') }}</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/services') }}"> {{ __('Modules') }}</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ url('groups') }}"> {{ __('Groups') }}</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ url('analysts') }}"> {{ __('Analysts') }}</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/users') }}">{{ __('Users') }}</a>
                            </li>
                        @endguest
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
                            <li class="nav-item dropdown ">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                My Account
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/profile">
                                        <i class="fa-solid fa-address-card me-1"></i> {{ __('Profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket me-1"></i> {{ __('Logout') }}
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

        <main class="p-4">
            @yield('content')
        </main>
    </div>
<script type="text/javascript">
    
</script>
</body>
</html>
