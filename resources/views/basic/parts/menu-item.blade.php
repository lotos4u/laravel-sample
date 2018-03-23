@is_permitted_any ($menu_item['permissions'])
<li @if(in_array(Route::currentRouteName(), $menu_item['routes'])) class="active" @endif>
    <a href="@if($menu_item['route']){{ route($menu_item['route']) }}@else{{ $empty_route }}@endif"
       class="@if(isset($menu_item['items'])) menu-toggle @endif @if(in_array(Route::currentRouteName(), $menu_item['routes'])) toggled @endif ">
        <i class="material-icons">@if(isset($menu_item['icon'])){{ $menu_item['icon'] }}@else {{ config('entity.' . $menu_item['model'] . '.icon') }} @endif</i><span>{{ __($menu_item['title_key']) }}</span></a>
    @if(isset($menu_item['items']))
        <ul class="ml-menu">
            @foreach($menu_item['items'] as $subitem)
                @include('basic.parts.menu-item', ['menu_item' => $subitem])
            @endforeach
        </ul>
    @endif
</li>
@end_is_permitted_any