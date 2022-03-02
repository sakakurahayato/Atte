<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Atte</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="container">
    @include('layouts.header')

    <main class="main">
        @yield('main')
    </main>

    @include('layouts.footer')
    <script src="{{asset('js/index.js')}}">
    </body>

</html>
