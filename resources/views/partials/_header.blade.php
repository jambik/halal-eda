<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
        @yield('head')
        <link href="http://fonts.googleapis.com/css?family=Cuprum:400,bold&amp;subset=cyrillic" type="text/css" rel="stylesheet" />
        <link href="{{ asset('/css/app.bundle.css') }}" type="text/css" rel="stylesheet" />
        <link href="{{ asset('/css/app.css') }}" type="text/css" rel="stylesheet" />
        <script src='https://www.google.com/recaptcha/api.js?hl=ru'></script>
        <script src="{{ asset('/js/app.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>
        <title>{{ $title or 'Халяль обеды в Москве' }}</title>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
