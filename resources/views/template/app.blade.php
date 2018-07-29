<!doctype html>
<!--[if IE 8]> <html lang="{{ config('app.locale')}}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="{{ config('app.locale') }}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{config('app.name')}} - @yield('titulo')</title>
    <link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta content="" name="description" />
    <meta content="" name="author" />
<body class="page-header-fixed page-sidebar-closed-hide-logo">
<div id="app">
    @yield('cuerpo')
</div>
<script src="{{mix('js/vendor.js')}}" type="text/javascript"></script>
<script src="{{mix('js/app.js')}}" type="text/javascript"></script>
</body>
</html>