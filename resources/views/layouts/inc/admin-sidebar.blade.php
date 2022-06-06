@php
$menus = config('menu');
@endphp
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @foreach ($menus as $menu)
            <li class="nav-item">
                @if (isset($menu['items']))
                    <a class="nav-link" data-toggle="collapse" href="#{{ $menu['label'] }}" aria-expanded="false"
                        aria-controls="ui-basic">
                        <i class="{{ $menu['icon'] }}"></i>
                        <span class="menu-title">{{ $menu['label'] }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="{{ $menu['label'] }}">
                        <ul class="nav flex-column sub-menu">
                            @foreach ($menu['items'] as $item)
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <a class="nav-link" href="{{ route($menu['route']) }}">
                        <i class="{{ $menu['icon'] }}"></i>
                        <span class="menu-title">{{ $menu['label'] }}</span>
                    </a>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
