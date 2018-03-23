{{--<form style="float: left;" method='{{ $btn_method }}'--}}
{{--action='@if (isset($btn_data)){{ route($btn_route, $btn_data) }}@else{{ route($btn_route) }}@endif'>--}}
{{--{{ Form::token() }}--}}

<button data-type="ajax-loader" data-token="{{ csrf_token() }}" data-url="{{ $action['url'] }}"
        @if (isset($action['class']))class="{{ $action['class'] }}" @endif
        @if (isset($action['text']))title="{{ $action['title'] }}" @endif
        type='submit'>
    @if(isset($action['text']))
        @if (isset($action['text_template'])) @include($action['text_template'], ['text' => $action['text']])
        @else {{ $action['text'] }}
        @endif
    @endif
</button>
{{--</form>--}}