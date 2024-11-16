<?php

use Illuminate\Support\Facades\View;

?>

@extends('adminlte-layout.master')

@section('adminlte_css')
    @yield('css')
@stop

@section('classes_body', 'lockscreen')

@php($password_reset_url = View::getSection('password_reset_url') ?? 'password/reset')
@php($dashboard_url = View::getSection('dashboard_url') ?? 'home')

@php($password_reset_url = $password_reset_url ? url($password_reset_url) : '')
@php($dashboard_url = $dashboard_url ? url($dashboard_url) : '')

@section('body')
    <div class="lockscreen-wrapper">
        {{-- Lockscreen logo --}}
        <div class="lockscreen-logo">
            <a href="{{ $dashboard_url }}">
                <img src="{{ asset('vendor/dist/img/AdminLTELogo.png') }}" height="50"
                     alt="AdminLTELogo">
                <b>Admin</b>LTE
            </a>
        </div>

        {{-- Lockscreen user name --}}
        <div class="lockscreen-name">
            {{ Auth::user()->name ?? Auth::user()->email }}
        </div>

        {{-- Lockscreen item --}}
        <div class="lockscreen-item">
            <form method="POST"
                  action="{{ route('password.confirm') }}"
                  class="lockscreen-credentials ml-0"
            >
                @csrf

                <div class="input-group">
                    <input id="password" type="password" name="password" autocomplete="current-password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="{{ __('adminlte-layout.adminlte.password') }}" required autofocus
                    >

                    <div class="input-group-append">
                        <button type="submit" class="btn">
                            <i class="fas fa-arrow-right text-muted"></i>
                        </button>
                    </div>
                </div>

            </form>
        </div>

        {{-- Password error alert --}}
        @error('password')
        <div class="lockscreen-subitem text-center" role="alert">
            <b class="text-danger">{{ $message }}</b>
        </div>
        @enderror

        {{-- Help block --}}
        <div class="help-block text-center">
            {{ __('adminlte-layout.adminlte.confirm_password_message') }}
        </div>

        {{-- Additional links --}}
        <div class="text-center">
            <a href="{{ $password_reset_url }}">
                {{ __('adminlte-layout.adminlte.i_forgot_my_password') }}
            </a>
        </div>

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
