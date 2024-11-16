<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @vite('resources/css/source-sans-pro.css')
    <link rel="stylesheet" href="{{asset('vendor/plugins/fontawesome-free/css/all.min.css')}}">
    @vite('resources/css/ionicons.min.css')
    <link rel="stylesheet"
          href="{{asset('vendor/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/plugins/jqvmap/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/dist/css/adminlte.min.css?v=3.2.0')}}">
    <link rel="stylesheet" href="{{asset('vendor/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/plugins/summernote/summernote-bs4.min.css')}}">
    @vite('resources/css/app.css')
    @stack('css')
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('layouts._top-navbar')
    @include('layouts._aside')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> @yield('content_header')</h1>
                    </div>

                    <div class="col-sm-6">
                        @yield('buttons')
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        @yield('breadcrumb')
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

{{--    @include('layouts._footer')--}}

    <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<script src="{{asset('vendor/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{asset('vendor/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendor/plugins/sparklines/sparkline.js')}}"></script>
<script src="{{asset('vendor/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('vendor/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{asset('vendor/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{asset('vendor/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('vendor/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('vendor/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{asset('vendor/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('vendor/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('vendor/dist/js/adminlte.js?v=3.2.0')}}"></script>
@stack('js')
@yield('js')
</body>
</html>
