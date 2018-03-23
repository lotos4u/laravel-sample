<a class="@if (isset($action['class'])) {{ $action['class'] }} @else waves-effect waves-block @endif"
   @if (isset($action['title'])) title="{{ $action['title'] }}"
   @endif href="{{ $action['url'] }}">@if (isset($action['text'])) {{ $action['text'] }} @endif</a>