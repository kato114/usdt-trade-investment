@extends('layouts.signin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-5 col-sm-12 mx-auto" style="margin-top: 20vh;">
              <div class="signin-wrapper">
                <div class="signin-wrapper-header text-center">
                  <div class="logo"><img src="{{ asset('images/logo.png') }}" alt="image"></div>
                  <h3 class="title">Login with</h3>
                  <p>Welcome back, please sign in below</p>
                </div>
                <form class="card" action="{{ route('login.verify') }}" method="get">
                  @csrf
                  <div class="form-group">
                    <label for="signinEmail">Email*</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your Email">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                  <button type="submit" class="btn btn-primary btn-hover">Log In</button>
                </form>
                <div class="signin-wrapper-footer">
                  <p class="bottom-text">Don’t have an account? <a href="{{ route('register') }}" data-toggle="modal" data-target="#signUpModal" data-dismiss="modal" aria-label="Close">Sign Up Now</a></p>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection