{{--<form style="float: left;" method='{{ $btn_method }}'--}}
{{--action='@if (isset($btn_data)){{ route($btn_route, $btn_data) }}@else{{ route($btn_route) }}@endif'>--}}
{{--{{ Form::token() }}--}}

<button data-type="ajax-loader" data-token="{{ csrf_token() }}" data-url="{{ route($btn_route, $btn_data) }}"
        @if (isset($btn_class))class="{{ $btn_class }}" @endif @if (isset($btn_title))title="{{ $btn_title }}"
        @endif type='submit'><i class='material-icons'>{{ $btn_text }}</i>
</button>
{{--</form>--}}