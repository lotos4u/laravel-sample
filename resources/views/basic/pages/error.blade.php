<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
          type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="{{ asset('lib/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/plugins/node-waves/waves.css') }}" rel="stylesheet"/>
    <link href="{{ asset('lib/css/style.css') }}" rel="stylesheet">
</head>
<body class="four-zero-four">
<div class="four-zero-four-container">
    <div class="error-code">{{ $code }}</div>
    <div class="error-message">{{ $text }}</div>
    <div class="button-place">
        <a href="{{ route($goto_route) }}" class="btn btn-default btn-lg waves-effect">{{ $goto_text }}</a>
    </div>
</div>
<script src="{{ asset('lib/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('lib/plugins/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('lib/plugins/node-waves/waves.js') }}"></script>
</body>
</html>
