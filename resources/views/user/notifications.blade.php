@extends('basic.pages.logged')

@section('central-content')
    @include('notification.list', ['notifications' => $notifications])
@endsection

@section('central-footer')

@endsection

