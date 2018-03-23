@extends('basic.pages.logged')

@section('central-content')
    @include('task.list', ['tasks' => $tasks])
@endsection

@section('central-footer')

@endsection

