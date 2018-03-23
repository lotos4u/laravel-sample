<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
    <i class="material-icons">flag</i>
    <span class="label-count">{{ count($user_shared_data['user_tasks']) }}</span>
</a>
<ul class="dropdown-menu">
    <li class="header">{{ __('main.menu_tasks') }}</li>
    <li class="body">
        <ul class="menu tasks">
            @foreach($user_shared_data['user_tasks'] as $i => $task)
                <li>
                    @if ($i < config('tasks.items_in_popup'))
                        <a href="{{ route('task.show', $task['id']) }}">
                            <h4>{{ $task['name'] }}
                                <small>32%</small>
                            </h4>
                            <div class="progress">
                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85"
                                     aria-valuemin="0"
                                     aria-valuemax="100" style="width: 32%">
                                </div>
                            </div>
                        </a>
                    @else
                        <a href="{{ route('user.profile') }}">
                            {{--<div class="icon-circle bg-light-green">--}}
                            {{--<i class="material-icons">keyboard_arrow_down</i>--}}
                            {{--</div>--}}
                            <div class="menu-info">
                                <h4>{{ __('main.menu_tasks_more', ['count' => count($user_shared_data['user_tasks'])-config('tasks.items_in_popup')]) }}</h4>
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
            <a href="javascript:void(0);">View All Tasks</a>
        </li>
    @endif
</ul>