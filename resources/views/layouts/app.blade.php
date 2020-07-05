<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Forum') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendor/tribute.css') }}" rel="stylesheet">

    <style>
        body { padding-bottom: 100px; }
        .level { display: flex; align-items: center; }
        .flex { flex: 1; }
        .mr-1 { margin-right: 1em; }
        .mr-2 { margin-right: 2em; }
        .ml-1 { margin-left: 1em; }
        .ml-2 { margin-left: 2em; }
        .mt-3 { margin-top: 3em; }
        [v-clock] { display: none; }
    </style>

    <script>
        window.App = {!! json_encode([
            'signedIn' => Auth::check(),
            'user' => Auth::user(),
        ]) !!}
    </script>

    @yield('header')
</head>
<body>
    <div id="app">
        @include('layouts.nav')

        <main class="py-5">
            @yield('content')

            <flash message="{{ session('flash') }}"></flash>
        </main>
    </div>
</body>
</html>
