<?php

use Illuminate\Support\Facades\View;

?>

@php($logout_url = View::getSection('logout_url') ?? 'logout')
@php( $logout_url = $logout_url ? url($logout_url) : '' )

<li class="nav-item">
    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-fw fa-power-off"></i>
        {{ __('adminlte-layout.adminlte.log_out') }}
    </a>
    <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</li>
