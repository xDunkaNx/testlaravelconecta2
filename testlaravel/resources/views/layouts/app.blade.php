<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="{{config('app.name')}}"  dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="twitter:widgets:csp" content="on">
    <meta name="theme-color" content="{{config('webconfig.themecolor')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TESTLARAVEL') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,500italic,700|Roboto+Mono:400,500,700|Google+Sans:400,500,700" rel="stylesheet" media="none" onload="if(media!='all')media='all'" />
    @stack('stylesheet')
</head>
<body>
    <div id="app">
        <main class="container-fluid">
            <div class="alert-container-main">
                @include('partials.alert')
            </div>
            @yield('content')
        </main>
        @yield('bottom')
    </div>
    @stack('scriptsload')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>