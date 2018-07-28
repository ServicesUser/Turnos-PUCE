<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{config('app.name')}} - @yield('titulo')</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="{{asset('css/invitado.css')}}" rel="stylesheet" type="text/css">
</head>
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
@yield('cuerpo')
@yield('js')
</body>
</html>