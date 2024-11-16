<li class="nav-item has-treeview {{$openParentClass }}">
    <a href="#"
       class="nav-link {{ $activeParentClass }}">
        <i class="nav-icon far {{ $item['icon'] }}"></i>
        <p>
            {{ $item['text'] }}
            <i class="right fas fa-angle-down"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        {!! $submenu !!}
    </ul>
</li>
