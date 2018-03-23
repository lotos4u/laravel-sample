<!DOCTYPE html>
<html lang="en">
<head>
    @include('parts.head')
</head>
<body>
<div id="app">
    @include('parts.header')
    @yield('content')
</div>
@include('parts.scripts')
</body>
</html>
