@extends('basic.pages.logged')

@section('central-content')
    @include('basic.parts.list', ['models' => $settings])
    {{--@include('setting.list', ['settings' => $settings])--}}
@endsection

@section('central-footer')

@endsection

