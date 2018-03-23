<button @if ($action->confirm)
        data-type="{{ $action->modal_type }}"
        data-url="{{ $action->url }}"
        data-token="{{ csrf_token() }}"
        data-method="{{ $action->method }}"
        @endif
        @if ($action->class)class="{{ $action->class }}" @endif
        @if ($action->text))title="{{ $action->title }}" @endif
        type='submit'>
    @if($action->text)
        @if ($action->text_template) @include($action->text_template, ['text' => $action->text])
        @else {{ $action->text }}
        @endif
    @endif
</button>