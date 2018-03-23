<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
    <i class="material-icons">notifications</i>
    <span class="label-count">{{ count($user_shared_data['user_notifications']) }}</span>
</a>
<ul class="dropdown-menu">
    <li class="header">{{ __('main.menu_notifications') }}</li>
    <li class="body">
        <ul class="menu">
            @foreach($user_shared_data['user_notifications'] as $i => $notification)
                <li>
                    @if ($i < config('notifications.items_in_popup'))
                        <a href="{{ route('notification.show', $notification['id']) }}">
                            <div class="icon-circle bg-light-green">
                                <i class="material-icons">@if($notification['sender_id'] == Auth::user()->id)
                                        keyboard_arrow_left @else  keyboard_arrow_right  @endif</i>
                            </div>
                            <div class="menu-info">
                                <h4>{{ $notification['subject'] }}</h4>
                                <p>
                                    <i class="material-icons">access_time</i> {{ $notification['created_at'] }} @if ($notification['sender_id'] != Auth::user()->id)
                                        from {{ str_limit($notification['sender']['name'], 8) }} @endif
                                </p>
                            </div>
                        </a>
                    @else
                        <a href="{{ route('user.profile') }}">
                            <div class="icon-circle bg-light-green">
                                <i class="material-icons">keyboard_arrow_down</i>
                            </div>
                            <div class="menu-info">
                                <h4>{{ __('main.menu_notifications_more', ['count' => count($user_shared_data['user_notifications'])-config('notifications.items_in_popup')]) }}</h4>
                                <p>...</p>
                            </div>
                        </a>
                        @break
                    @endif
                </li>
            @endforeach
        </ul>
    </li>
    @if (false)
        <li class="footer">
            <a href="{{ route('user.profile') }}">{{ __('main.menu_notifications_all') }}</a>
        </li>
    @endif
</ul>