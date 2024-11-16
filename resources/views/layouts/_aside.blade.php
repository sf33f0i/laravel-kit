<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand-link">
        <img style="padding-left: 15px"
             src="{{ asset('vendor/dist/img/AdminLTELogo.png') }}"
             height="40" alt="">
        <b>Admin</b>LTE
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/vendor/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>

            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <nav class="mt-2">
            <x-admin-menu
                :items="config('admin-menu')"
            />
        </nav>
    </div>
</aside>
