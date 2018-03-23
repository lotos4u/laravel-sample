<?php $id = str_random(40); ?>
<form id="{{ $id }}" action="{{ $action['link'] }}" method="{{ $action['method'] }}">
    {{ csrf_field() }}
</form>
<a href="#" @if (isset($action['class']))class="{{ $action['class'] }}"
   @endif title="{{ $action['text'] }}" onclick="event.preventDefault(); document.getElementById('{{ $id }}').submit();">
    {{ $action['text'] }}
</a>
