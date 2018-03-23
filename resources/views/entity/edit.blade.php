@extends('basic.pages.logged')

@section('central-content')
    @include('entity.blocks.edit')
@endsection

@section('central-footer')
    <a href="{{ route($model_name . '.index') }}">{{ __($model_name . '.button_back_to_list') }}</a>
@endsection

@if (isset($block_related_lists))
    @section('custom-javascript')
        @include('basic.parts.tables-scripts')
    @endsection
@endif