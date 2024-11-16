@extends('adminlte-layout.auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', __('adminlte-layout.adminlte.verify_message'))

@section('auth_body')

    @if(session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('adminlte-layout.adminlte.verify_email_sent') }}
        </div>
    @endif

    {{ __('adminlte-layout.adminlte.verify_check_your_email') }}
    {{ __('adminlte-layout.adminlte.verify_if_not_recieved') }},

    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
            {{ __('adminlte-layout.adminlte.verify_request_another') }}
        </button>.
    </form>

@stop
