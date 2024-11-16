<nav class="main-header navbar">
    {{-- Navbar brand logo --}}
    @include('adminlte-layout.partials.common.brand-logo-xs')

    {{-- Navbar toggler button --}}
    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    {{-- Navbar collapsible menu --}}
    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        {{-- Navbar left links --}}
        <ul class="nav navbar-nav">
            {{-- Configured left links --}}
            @each('adminlte-layout.partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

            {{-- Custom left links --}}
            @yield('content_top_nav_left')
        </ul>
    </div>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto order-1 order-md-3 navbar-no-expand">
        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        {{-- Configured right links --}}
        @each('adminlte-layout.partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

        {{-- User menu link --}}
        @if(Auth::user())
            @include('adminlte-layout.partials.navbar.menu-item-logout-link')
        @endif
    </ul>
</nav>
