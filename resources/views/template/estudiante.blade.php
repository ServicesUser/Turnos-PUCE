<!doctype html>
<!--[if IE 8]> <html lang="{{ config('app.locale')}}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="{{ config('app.locale') }}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{config('app.name')}} | @yield('titulo')</title>
    <link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta content="" name="description" />
    <meta content="" name="author" />
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">
<div id="app">
    <div class="wrapper">
        <header class="page-header">
            <nav class="navbar mega-menu" role="navigation">
                <div class="container-fluid">
                    <div class="clearfix navbar-fixed-top">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                            <span class="sr-only">Navegacion</span>
                            <span class="toggle-icon">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </span>
                        </button>
                        <a class="page-logo" href="/">
                            <img src="{{asset('/images/logo_puce_blanco.png')}}" alt="Logo PUCE">
                        </a>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container-fluid">
            <div class="page-content">
                <div class="breadcrumbs">
                    <h1>@yield('titulo')</h1>
                </div>
                @yield('cuerpo')
            </div>
            <pie></pie>
        </div>
    </div>
</div>
@component('componentes.soporte')
@endcomponent
<script src="{{mix('js/vendor.js')}}" type="text/javascript"></script>
<script src="{{mix('js/app.js')}}" type="text/javascript"></script>
</body>
</html>