<li class="nav-item">
    <a class="nav-link {{ request()->routeIs($route) ? 'active' : '' }}" href="{{ route($route) }}">
        @if(!empty($icon))
            <span data-feather="{{ $icon }}"></span>
        @endif
        {{ $text }}
    </a>
</li>
