<?php

use Illuminate\Support\Facades\View;

?>

@extends('adminlte-layout.master')

@php($dashboard_url = View::getSection('dashboard_url') ?? 'home')
@php($dashboard_url = $dashboard_url ? url($dashboard_url) : '' )

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body')
    {{ ($auth_type ?? 'login') . '-page' }}
@stop

@section('body')
    <div class="{{ $auth_type ?? 'login' }}-box">
        {{-- Logo --}}
        <div class="{{ $auth_type ?? 'login' }}-logo">
            <a href="/login">
                <img src="{{ asset('vendor/dist/img/AdminLTELogo.png') }}" height="50"
                     alt="">
                <b>Admin</b>LTE
            </a>
        </div>

        {{-- Card Box --}}
        <div class="card card-outline card-primary">
            {{-- Card Header --}}
            @hasSection('auth_header')
                <div class="card-header">
                    <h3 class="card-title float-none text-center">
                        @yield('auth_header')
                    </h3>
                </div>
            @endif

            {{-- Card Body --}}
            <div class="card-body {{ $auth_type ?? 'login' }}-card-body">
                @yield('auth_body')
            </div>

            {{-- Card Footer --}}
            @hasSection('auth_footer')
                <div class="card-footer">
                    @yield('auth_footer')
                </div>
            @endif
        </div>
    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
