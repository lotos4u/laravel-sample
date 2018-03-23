@extends('basic.blocks.content')
@if (isset($title))
@section('block-title')
    {{ $title }}
@endsection
@endif
@if (isset($subtitle))
@section('block-subtitle')
    {{ $subtitle }}
@endsection
@endif
@section('block-content')
    @if (count($models) > 0)
        <table id="{{ $grid_id }}" class="table table-condensed table-hover table-striped">
            <thead>
            <tr>
                @foreach($titles as $item)
                    <th {!! $item['settings'] !!}>{{ $item['title'] }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($models as $model)
                <tr>
                    @foreach($fields as $field)
                        @if(is_array($field))
                            @foreach($field as $subfield)
                                <td>{{ $subfield }}</td>
                            @endforeach
                        @else
                            <td>@if(isset($model[$field])){{$model[$field]}}@endif</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        {{ __('main.string_nodata') }}
    @endif
@endsection