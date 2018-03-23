@if($user_shared_data['theme_name'] == $theme_color['internal_name'])
    <li data-theme="{{ $theme_color['form_name'] }}" class="active">
@else
    <li data-theme="{{ $theme_color['form_name'] }}" onclick="document.getElementById('theme-select-form-{{ $theme_color['internal_name'] }}').submit();">
        <form id="theme-select-form-{{ $theme_color['internal_name'] }}" action="{{ route('setting.theme') }}"
              method="POST">
            {{ Form::token() }}
            <input name="theme_name" type="hidden" value="{{ $theme_color['internal_name'] }}">
        </form>
        @endif
        <div class="{{ $theme_color['form_name'] }}"></div>
        <span>{{ $theme_color['display_name'] }}</span>
    </li>