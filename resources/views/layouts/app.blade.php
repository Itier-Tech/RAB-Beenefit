<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Beenefit') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/navbar.css'])
    @livewireStyles
</head>
<body>
    <div >
        <main class="d-flex w-100 h-100">
            @yield('content')
        </main>

        @if(session()->has('loginError'))
            <div class="aler alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button> type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
    </div>
    @livewireScripts
</body>
</html>
