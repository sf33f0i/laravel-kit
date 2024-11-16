<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

?>

@php($logout_url = View::getSection('logout_url') ?? 'logout')
@php($profile_url = View::getSection('profile_url') ?? 'logout')
@php($profile_url = $profile_url ? url($profile_url) : '')
@php($logout_url = $logout_url ? url($logout_url) : '')

<li class="nav-item dropdown user-menu">
    {{-- User menu toggler --}}
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <span>{{ Auth::user()->name }}</span>
    </a>

    {{-- User menu dropdown --}}
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        {{-- User menu header --}}
        @yield('usermenu_header')

        {{-- Configured user menu links --}}
        @each('adminlte-layout.partials.navbar.dropdown-item', $adminlte->menu("navbar-user"), 'item')

        {{-- User menu body --}}
        @hasSection('usermenu_body')
            <li class="user-body">
                @yield('usermenu_body')
            </li>
        @endif

        {{-- User menu footer --}}
        <li class="user-footer">
            @if($profile_url)
                <a href="{{ $profile_url }}" class="btn btn-default btn-flat">
                    <i class="fa fa-fw fa-user"></i>
                    {{ __('adminlte-layout.menu.profile') }}
                </a>
            @endif
            <a class="btn btn-default btn-flat float-right @if(!$profile_url) btn-block @endif"
               href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-power-off"></i>
                {{ __('adminlte-layout.adminlte.log_out') }}
            </a>
            <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>

    </ul>

</li>
