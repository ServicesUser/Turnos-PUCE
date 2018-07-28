<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name')}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="login">
<div id="app">
    <div class="logo">
        <a href="index.html">
            <img src="https://www.tailorbrands.com/wp-content/uploads/2017/07/logo8.png" alt="">
        </a>
    </div>
    <main>
        @yield('cuerpo')
    </main>
</div>
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
