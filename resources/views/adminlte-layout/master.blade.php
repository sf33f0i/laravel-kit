<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', '')
        @yield('title', 'AdminLTE 3')
        @yield('title_postfix', '')
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    <link rel="stylesheet" href="{{ asset('vendor/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    {{-- Configured Stylesheets --}}
    @include('adminlte-layout.plugins', ['type' => 'css'])

    <link rel="stylesheet" href="{{ asset('vendor/dist/css/adminlte.min.css?v=3.2.0') }}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"
    >

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}"/>
    {{--    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}"/>--}}
    {{--    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">--}}
    {{--    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">--}}
    {{--    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">--}}
    {{--    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">--}}
    {{--    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">--}}
    {{--    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">--}}
    {{--    <meta name="msapplication-TileColor" content="#ffffff">--}}
    {{--    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">--}}
</head>

<body class="@yield('classes_body')" @yield('body_data')>

{{-- Body Content --}}
@yield('body')

{{-- Base Scripts --}}
<script src="{{ asset('vendor/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

{{-- Configured Scripts --}}
@include('adminlte-layout.plugins', ['type' => 'js'])

<script src="{{ asset('vendor/dist/js/adminlte.min.js') }}"></script>

{{-- Custom Scripts --}}
@yield('adminlte_js')

</body>

</html>
