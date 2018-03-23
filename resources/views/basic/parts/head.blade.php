<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Laravel') }}</title>
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<link href="{{ asset('lib/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('lib/plugins/node-waves/waves.css') }}" rel="stylesheet"/>
<link href="{{ asset('lib/plugins/animate-css/animate.css') }}" rel="stylesheet"/>
<link href="{{ asset('lib/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>
<link href="{{ asset('lib/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
<link href="{{ asset('lib/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet"/>
<link href="{{ asset('lib/plugins/morrisjs/morris.css') }}" rel="stylesheet"/>
<link href="{{ asset('lib/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('lib/css/themes/' . $user_shared_data['theme_name'] . '.css') }}" rel="stylesheet"/>
<link href="{{ asset('grid/jquery.bootgrid.css') }}" rel="stylesheet"/>
<link href="{{ asset('css/app-fix.css') }}" rel="stylesheet"/>
<script>
    window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
</script>