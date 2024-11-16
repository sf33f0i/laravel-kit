<?php

use Illuminate\Support\Facades\View
?>

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@php($dashboard_url = View::getSection('dashboard_url') ?? 'home')
@php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )

<a href="{{ $dashboard_url }}"
   @if($layoutHelper->isLayoutTopnavEnabled())
       class="navbar-brand"
   @else
       class="brand-link"
    @endif>

    {{-- Small brand logo --}}
    <img src="{{ asset('/vendor/dist/img/AdminLTELogo.png') }}"
         alt="AdminLTE"
         class="brand-image img-circle elevation-3"
         style="opacity:.8">

    {{-- Brand text --}}
    <span class="brand-text font-weight-light">
        <b>Admin</b>LTE
    </span>

</a>
