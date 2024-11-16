{{--@extends('adminlte-layout.master')--}}

{{--@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')--}}

{{--@if($layoutHelper->isLayoutTopnavEnabled())--}}
@php( $def_container_class = 'container' )
{{--@else--}}
{{--    @php( $def_container_class = 'container-fluid' )--}}
{{--@endif--}}

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', '')

@section('body_data', '')

@section('body')
    <div class="wrapper">

        {{-- Top Navbar --}}
        {{--        @if($layoutHelper->isLayoutTopnavEnabled())--}}
        @include('adminlte-layout.partials.navbar.navbar-layout-topnav')
        {{--        @else--}}
        {{--            @include('adminlte-layout.partials.navbar.navbar')--}}
        {{--        @endif--}}

        {{-- Left Main Sidebar --}}
        {{--        @if(!$layoutHelper->isLayoutTopnavEnabled())--}}
        @include('adminlte-layout.partials.sidebar.left-sidebar')
        {{--        @endif--}}

        {{-- Content Wrapper --}}
        <div class="content-wrapper">

            {{-- Content Header --}}
            <div class="content-header">
                <div class="{{ $def_container_class }}">
                    @yield('content_header')
                </div>
            </div>

            {{-- Main Content --}}
            <div class="content">
                <div class="{{ $def_container_class }}">
                    @yield('content')
                </div>
            </div>
        </div>

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte-layout.partials.footer.footer')
        @endif
    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
