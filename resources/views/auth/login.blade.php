@extends('layouts.single')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-login mx-auto">
                <div class="text-center mb-6">
                    <img src="{{ asset('images/logo.svg') }}" class="h-6" alt="">
                </div>
                <form class="card" action="{{ route('login') }}" method="post">
                    <div class="card-body p-6">
                        <div class="card-title">Login to your account</div>
                        <div class="form-group">
                            <label class="form-label">Email address</label>
                            <input id="email" placeholder="Email/Phone"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input id="password" placeholder="Password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        @csrf
                        <div class="form-group">
                            <label class="form-label">
                                <a href="{{ route('password.request') }}" class="float-right small bg-none">I forgot
                                    password</a>
                            </label>
                            &nbsp;
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="mt-6 btn btn-primary btn-block">Sign in</button>
                        </div>
                    </div>
                </form>
                <div class="text-center text-muted">
                    Don't have account yet? <a href="{{ route('register') }}">Sign up</a>
                </div>
            </div>
        </div>
    </div>
@endsection
