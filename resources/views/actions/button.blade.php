<?php $id = str_random(40); ?>
<form id="{{ $id }}" action="{{ $action->url }}" method="{{ $action->method }}">
    {{ csrf_field() }}
</form>
<a href="#" @if ($action->class)class="{{ $action->class }}"
   @endif @if ($action->title) title="{{ $action->title }}"
   @endif onclick="event.preventDefault(); document.getElementById('{{ $id }}').submit();">
    @if($action->text) @if ($action->text_template) @include($action->text_template, ['text' => $action->text]) @else {{ $action->text }} @endif  @endif
</a>
