<li class="nav-item">
    <a href="{{ route($item['route']) }}"
       class="nav-link {{ $activeItemClass }}">
        <i class="nav-icon fas {{ $item['icon'] }}"></i>
        <p>{{ $item['text'] }}</p>
    </a>
</li>
