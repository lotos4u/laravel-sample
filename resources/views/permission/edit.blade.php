@extends('basic.pages.logged')

@section('central-content')
    <div>
        <strong>{{ __('permission.string_name') }}:</strong>
        {{ $permission->name }}
    </div>
    <div>
        <strong>{{ __('permission.string_mandatory') }}:</strong>
        @if ($permission->isMandatory())
            {{ __('permission.string_positive') }}
        @else
            {{ __('permission.string_negative') }}
        @endif
    </div>
    <div>
        <strong>{{ __('permission.string_description') }}:</strong>
        {{ $permission->description }}
    </div>
@endsection

@section('central-footer')
    <a href="{{ route('permission.show', $permission->id) }}">{{ __('permission.button_back_to_item') }}</a>
    <a href="{{ route('permission.index') }}">{{ __('permission.button_back_to_list') }}</a>
@endsection

