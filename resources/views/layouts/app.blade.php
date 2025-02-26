<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <title>{{ config('app.name', 'Qops') }}</title> -->
    <title>QOPS | Quality Operations</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/images/download1.svg') }}" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8aea7295a5.js" crossorigin="anonymous"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.bootstrap5.css" />
    <script type="text/javascript">
    var domain = "{{ url('/') }}";
    var api    = "{{ url('/api/v1') }}";
    </script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/dashboard') }}">
                    <img src="{{ url('/images/download.svg') }}" alt="" title="" height="35">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto text-uppercase fw-bold gap-2">
                        @guest
                        @else
                        <li class="nav-item">
                            <a id="navbarDropdown" class="nav-link" href="{{ url('dashboard') }}" role="button">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                New
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/tickets/create/1"> PureCloud </a>
                                <a class="dropdown-item" href="/tickets/create/4"> ALL </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Tickets
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('tickets') }}"> <i class="fa-solid fa-border-all me-1"></i> All </a>
                                <a class="dropdown-item" href="{{ url('tickets/download') }}"><i class="fa-solid fa-download me-1"></i> Download </a>
                                @if( auth()->user()->role_id==1 OR auth()->user()->role_id==5)
                                <a class="dropdown-item" href="{{ url('tickets/upload') }}"> <i class="fa-solid fa-upload me-1"></i> Upload </a>
                                @endif
                            </div>
                        </li>
                        @if( auth()->user()->role_id==1 OR auth()->user()->role_id==5)
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
                        @endif
                        @endguest
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto ">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif
                       <!-- @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif -->
                        @else
                        <form class="navbar-form navbar-left" action="{{ url('/tickets/qsearch') }} ">
                            <input type="search" class="form-control " placeholder="Search...." name="q" required>
                        </form>
                        <li class="nav-item dropdown ">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                My Account
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/profile">
                                    <i class="fa-solid fa-address-card me-1"></i> {{ __('Profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
        <main class="p-4" id="content">
            @yield('content')
        </main>
    </div>
    <!-- Include jQuery -->
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
    <script>
    $(function() {
        $(".select2").selectize([]);
    });
    </script>
    @yield('scripts')
</body>

</html>
