<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>QOPS | Quality Operations</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/images/download1.svg') }}" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8aea7295a5.js" crossorigin="anonymous"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        .login-image {
    background-image: url(/images/bg4.jpg)!important;
    background-size: cover!important;
    min-height: 100vh!important;
}   
</style>
</head>

<body class="antialiased">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <!-- login form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row mb-5 text-center">
                        <div class="col-md-12">
                            <img src="{{ url('/images/download1.svg') }}" alt="" title="" height="35" class="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-form-label ">{{ __('Email') }}</label>
                        <div class="">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-form-label">{{ __('Password') }}</label>
                        <div class="">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary w-100">{{ __('Login') }}</button>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-12">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </form>
                <!-- end login form -->
            </div>
            <div class="col-md-6 login-image">
                <img src="{{ url('/images/download1.svg') }}" alt="" title="" height="35" class="text-white" style="position:absolute; top:10px; right:10px; color: #fff;">
            </div>
        </div>
    </div>
</body>

</html>
