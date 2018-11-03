@extends('layouts.auth')

@section('htmlheader_title')
    Registro
@endsection

@section('content')

<body class="hold-transition register-page">
    <div id="app" v-cloak>
        <div class="register-box">
            <div class="register-logo">
                <a href="{{ url('/home') }}">
                    <img src="@if (Config::find(6)->val != NULL) {{ Config::find(6)->val }} @endif" alt="{{ Config::find(6)->name }}" class="img-circle elevation-3"
                    style="opacity: .8; width: 200px; height: 100px;">
                </a>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> {{ trans('message.someproblems') }}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">{{ trans('message.registermember') }}</p>

                    <register-form></register-form>
                <div class="social-auth-links text-center">
                        <p>- OR -</p>
                    @include('partials.socials')
                </div>
                    <a href="{{ url('/login') }}" class="text-center">{{ trans('message.membership') }}</a>
                </div><!-- /.form-box -->
            </div>
        </div><!-- /.register-box -->
    </div>

    @include('layouts.partials.scripts_auth')

    @include('auth.terms')

</body>

@endsection
