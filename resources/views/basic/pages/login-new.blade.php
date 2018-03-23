<!DOCTYPE html>
<html lang="en">
<head>
    @include('parts.head')
</head>
<body>
<div id="app">
    @include('parts.header')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @yield('central-content')
                </div>
            </div>
        </div>
    </div>
</div>
@include('parts.scripts')
</body>
</html>
