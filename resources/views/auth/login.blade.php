@extends('layouts.auth') 
@section('htmlheader_title') Log in
@endsection
 
@section('content')

<body class="hold-transition login-page">
        <div class="login-box" id="app" v-cloak>
            <div class="login-logo">
                <a href="{{ url('/home') }}">
                    <img src="@if (Config::find(6)->val != NULL) {{ Config::find(6)->val }} @endif" alt="{{ Config::find(6)->name }}" class="img-circle elevation-3"
                    style="opacity: .8; width: 200px; height: 100px;">
                </a>
            </div>
            <!-- /.login-logo -->

            <div class="card panel-info">
                <div class="card-header">{{ trans('message.siginsession') }}</div>
                <div class="card-body login-card-body">

                    <login-form name="{{ config('auth.providers.users.field','email') }}" domain="{{ config('auth.defaults.domain','') }}"></login-form>

                    {{--
                        @include('auth.partials.social_login') --}}
                    <div class="social-auth-links text-center mb-3">
                        <p>- OR -</p>
                        @include('partials.socials')
                    </div>
                    <p class="mb-1">
                        <a href="{{ url('/password/reset') }}">{{ trans('message.forgotpassword') }}</a>
                    </p>
                    <p class="mb-0">
                        <a href="{{ url('/register') }}" class="text-center">{{ trans('message.registermember') }}</a>
                    </p>
                </div>
            </div>

        </div>
    @include('layouts.partials.scripts_auth')
</body>
@endsection