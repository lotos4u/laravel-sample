<a class="@if ($action->class) {{ $action->class }} @endif"
   @if ($action->confirm)
   data-type="{{ $action->modal_type }}"
   data-url="{{ $action->url }}"
   data-method="{{ $action->method }}"
   data-token="{{ csrf_token() }}"
   @endif
   @if ($action->title) title="{{ $action->title }}"
   @endif href="@if ($action->confirm)#@else{{ $action->url }}@endif">@if ($action->text) @if ($action->text_template) @include($action->text_template, ['text' => $action->text]) @else {{ $action->text }} @endif @endif</a>