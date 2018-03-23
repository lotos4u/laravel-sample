<div class="user-info">
    <div class="image">
        <img src="{{ asset($user->image) }}" width="48" height="48" alt="User"/>
    </div>
    <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $user->name }}</div>
        <div class="email">{{ $user->email }}</div>
        <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
                <li>
                    <a href="{{ route('user.profile') }}"><i
                                class="material-icons">person</i>{{ __('main.menu_profile') }}</a></li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>{{ __('main.menu_logout') }}
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>