<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Turnero</title>
    <link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta content="" name="description" />
    <meta content="" name="author" />
</head>
<body>
<div id="turnero">
    <dispensador2></dispensador2>
</div>
<script src="{{mix('js/vendor.js')}}" type="text/javascript"></script>
<script src="{{mix('js/turnero.js')}}" type="text/javascript"></script>
</body>
</html>