<aside class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- Sidebar brand logo --}}
    @include('adminlte-layout.partials.common.brand-logo-xs')

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview" role="menu"
                data-accordion="false"
            >
                {{-- Configured sidebar links --}}
                @each('adminlte-layout.partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>
</aside>
