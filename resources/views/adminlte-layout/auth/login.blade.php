<?php

use Illuminate\Support\Facades\View
?>

@extends('adminlte-layout.auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('/vendor/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? 'login')
@php( $register_url = View::getSection('register_url') ?? 'register')
@php( $password_reset_url = View::getSection('password_reset_url') ?? 'password/reset')

@php( $login_url = $login_url ? url($login_url) : '' )
@php( $register_url = $register_url ? url($register_url) : '' )
@php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )

@section('auth_header', 'Авторизация')

@section('auth_body')
    <form action="{{ $login_url }}" method="post">
        {{ csrf_field() }}

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                   value="{{ old('email') }}" placeholder="Email" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @if($errors->has('email'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password"
                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                   placeholder="Пароль">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @if($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-7">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Запомнить</label>
                </div>
            </div>
            <div class="col-5">
                <button type=submit
                        class="btn btn-block btn-flat btn-primary">
                    <span class="fas fa-sign-in-alt"></span>
                    Войти
                </button>
            </div>
        </div>
    </form>
@stop

@section('auth_footer')
    {{-- Password reset link --}}
    {{--    @if($password_reset_url)--}}
    {{--        <p class="my-0">--}}
    {{--            <a href="{{ $password_reset_url }}">--}}
    {{--                Сбросить пароль--}}
    {{--            </a>--}}
    {{--        </p>--}}
    {{--    @endif--}}

    {{-- Register link --}}
    {{--    @if($register_url)--}}
    {{--        <p class="my-0">--}}
    {{--            <a href="{{ $register_url }}">--}}
    {{--                Зарегистрироваться--}}
    {{--            </a>--}}
    {{--        </p>--}}
    {{--    @endif--}}
@stop
