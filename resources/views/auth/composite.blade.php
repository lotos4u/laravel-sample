@extends('basic.pages.login-new')
@section('central-content')
    <div class="login-form active" id='login-form'>
        <div class="panel-heading">{{ __('auth.login_title') }}</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">{{ __('auth.email') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email"
                               value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">{{ __('auth.password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"
                                       name="remember" {{ old('remember') ? 'checked' : '' }}>{{ __('auth.remember_me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 col-md-offset-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('auth.login_button') }}
                        </button>

                        <a class="btn btn-link" href="#" onclick="show_form('login-form', 'forgotpassword-form');">
                            {{ __('auth.forgot') }}
                        </a>

                        <a class="btn btn-link" href="#" onclick="show_form('login-form', 'registration-form');">
                            {{ __('auth.register_link') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="registration-form" id='registration-form'>
        <div class="panel-heading">{{ __('auth.register_title') }}</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">{{ __('auth.name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name"
                               value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">{{ __('auth.email') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email"
                               value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">{{ __('auth.password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm"
                           class="col-md-4 control-label">{{ __('auth.password_confirm') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 col-md-offset-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('auth.register_button') }}
                        </button>
                        <a class="btn btn-link" href="#" onclick="show_form('registration-form', 'forgotpassword-form');">
                            {{ __('auth.forgot') }}
                        </a>
                        <a class="btn btn-link" href="#" onclick="show_form('registration-form', 'login-form');">
                            {{ __('auth.login_link') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="forgotpassword-form" id='forgotpassword-form'>
        <div class="panel-heading">{{ __('auth.email_title') }}</div>
        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">{{ __('auth.email') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email"
                               value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 col-md-offset-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('auth.email_button') }}
                        </button>

                        <a class="btn btn-link" href="#" onclick="show_form('forgotpassword-form', 'login-form');">
                            {{ __('auth.login_link') }}
                        </a>

                        <a class="btn btn-link" href="#" onclick="show_form('forgotpassword-form', 'registration-form');">
                            {{ __('auth.register_link') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    function show_form(form_to_hide, form_to_show) {
        console.log(form_to_hide);
        console.log(form_to_show);
        var el = document.getElementById(form_to_show);
        el.classList.add("active");
        var el2 = document.getElementById(form_to_hide);
        el2.classList.remove("active");
    }
</script>