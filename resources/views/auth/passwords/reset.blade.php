@extends('layouts.single')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-login mx-auto">
                <div class="text-center mb-6">
                    <img src="{{ asset('images/logo.svg') }}" class="h-6" alt="">
                </div>
                <form class="card" action="{{ route('password.update',['guard' => request('guard')])  }}" method="post">
                    <div class="card-body p-6">
                        <div class="card-title">{{ __('Reset Password') }}</div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
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
                            <input id="password" placeholder="New Password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" value="{{ old('password') }}" required autofocus>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password Confirmation</label>
                            <input id="email" placeholder="Password Confirmation"
                                   class="form-control" type="password"
                                   name="password_confirmation" value="" required autofocus>
                        </div>
                        @csrf
                        <div class="form-footer">
                            <button type="submit"
                                    class="mt-6 btn btn-primary btn-block">{{  __('Reset Password') }}</button>
                        </div>
                    </div>
                </form>
                {{--                <div class="text-center text-muted">--}}
                {{--                    Don't have account yet? <a href="{{ route('register') }}">Sign up</a>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
