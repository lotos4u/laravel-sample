@if(isset($block_actions))
    @if (is_array($block_actions))
        <ul class="header-dropdown m-r--5">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                </a>
                <ul class="dropdown-menu pull-right">
                    @foreach($block_actions as $action)
                        <li>{!! $action !!}</li>
                    @endforeach
                </ul>
            </li>
        </ul>
    @endif
@endif