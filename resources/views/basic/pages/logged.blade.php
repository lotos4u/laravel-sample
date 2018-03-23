<!DOCTYPE html>
<html lang="en">
<head>
    @include('basic.parts.head')
</head>
<body class="{{ $user_shared_data['theme_name'] }}">
<passport-clients></passport-clients>
<passport-authorized-clients></passport-authorized-clients>
<passport-personal-access-tokens></passport-personal-access-tokens>
<div class="page-loader-wrapper" style="display: none;">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>{{ __('title_wait') }}</p>
    </div>
</div>
<div class="overlay"></div>
<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>
<div id="app">
    @include('basic.parts.header')
    <section>
        @include('basic.parts.leftbar')
    </section>
    <section>
        @include('basic.parts.rightbar')
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                @include('basic.parts.internal-messages')
                @if(isset($model))
                    {!! Breadcrumbs::render(Route::currentRouteName(), $model) !!}
                @else
                    {!! Breadcrumbs::render(Route::currentRouteName()) !!}
                @endif
                <small>
                    @yield('central-subheader')
                </small>
            </div>
            @yield('central-content')
            @yield('central-footer')
        </div>
    </section>
</div>
@include('basic.parts.scripts')
@yield('custom-javascript')
</body>
</html>