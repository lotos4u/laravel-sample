<aside id="leftsidebar" class="sidebar">
    @include('basic.parts.user', ['user' => Auth::user()])
    <div class="menu">
        <ul class="list">
            @foreach(config('menus.main.items') as $item)
                @include('basic.parts.menu-item', ['menu_item' => $item, 'empty_route' => config('menus.main.empty_route')])
            @endforeach
        </ul>
    </div>
</aside>