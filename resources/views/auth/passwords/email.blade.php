@extends('layouts.auth') 
@section('htmlheader_title') Password recovery
@endsection
 
@section('content')

<body class="login-page">
    <div id="app">

        <div class="login-box">
            <div class="login-logo">
                <a href="{{ url('/home') }}"><b>Admin</b>LTE</a>
            </div>
            <!-- /.login-logo -->

            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif 
            <div class="card">
                <div class="login-card-body">
                    <p class="login-card-msg">Reset Password</p>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                    required> @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-6">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Enviar email') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="{{ url('/login') }}">Log in</a>
                    </p>
                    {{-- <p class="mb-0">
                        <a href="{{ url('/register') }}" class="text-center">{{ trans('message.registermember') }}</a>
                    </p> --}}
                </div>
                <!-- /.login-box-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>
    @include('layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>
@endsection