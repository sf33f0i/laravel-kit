<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('vendor/plugins/jqvmap/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/dist/css/adminlte.min.css?v=3.2.0')}}">
    @vite('resources/css/app.css')
    @stack('css')
    @yield('css')
</head>
<body>
@yield('content')
</body>
</html>
