@inject('sidebarStore', 'App\Admin\SidebarStore')

<div class="list-group">
    @foreach($sidebarStore->items() as $name => [$route, $pattern])
        <a href="{{ route($route) }}" class="list-group-item {{ request()->routeIs($pattern) ? 'active' : '' }}">
            {{ $name }}
        </a>
    @endforeach
</div>
