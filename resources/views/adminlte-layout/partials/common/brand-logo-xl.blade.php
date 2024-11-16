<?php

use Illuminate\Support\Facades\View;

?>

@inject('layoutHelper', \JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper)

@php($dashboard_url = View::getSection('dashboard_url') ?? 'home')

@php($dashboard_url = $dashboard_url ? url($dashboard_url) : '' )

<a href="{{ $dashboard_url }}"
   @if($layoutHelper->isLayoutTopnavEnabled())
       class="navbar-brand logo-switch"
   @else
       class="brand-link logo-switch"
    @endif>

    {{-- Small brand logo --}}
    <img src="{{ asset('/vendor/dist/img/AdminLTELogo.png') }}"
         alt="AdminLTE"
         class="brand-image-xl logo-xs">

    {{-- Large brand logo --}}
{{--    <img src="{{ asset(config('adminlte.logo_img_xl')) }}"--}}
{{--         alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"--}}
{{--         class="{{ config('adminlte.logo_img_xl_class', 'brand-image-xs') }} logo-xl">--}}
</a>
