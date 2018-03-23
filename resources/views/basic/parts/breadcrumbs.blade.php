@if ($breadcrumbs)
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$breadcrumb->last)
                <li><a href="{{ $breadcrumb->url }}"><i class="material-icons"> {{ $breadcrumb->icon }}</i>{{ $breadcrumb->title }}</a></li>
            @else
                <li class="active"><i class="material-icons"> {{ $breadcrumb->icon }}</i>{{ $breadcrumb->title }}</li>
            @endif
        @endforeach
    </ol>
@endif