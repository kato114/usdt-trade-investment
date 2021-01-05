@extends('layouts.signin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-5 col-sm-12 mx-auto" style="margin-top: 20vh;">
              <div class="signin-wrapper">
                <div class="signin-wrapper-header text-center">
                  <div class="logo"><img src="{{ $client->photo }}" alt="image" style="border-radius: 50%;"></div>
                  <h3 class="title">{{ $client->name }}</h3>
                  <a class="pl-0" href="{{ route('password.request', ['guard' => $client->role]) }}">
                    {{ __('I forgot my Password') }}
                  </a>
                </div>
                <form class="card" action="{{ route('login') }}" method="post">
                  @csrf
                  <input type="hidden" name="email" value="{{ $client->email }}">
                  <input type="hidden" name="guard" value="{{ $client->role}}">
                  <div class="form-group">
                    <label for="signinPass">Password*</label>
                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="signinPass" name="password" value="" required autofocus placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <div class="custom-checkbox">
                      <input type="checkbox" name="id-1" id="id-1" checked>
                      <label for="id-1">Remember Password</label>
                      <span class="checkbox"></span>
                    </div>
                  </div>
                  <div class="form-group">
                      <a class="col-4 float-left btn btn-sm btn-secondary" href="{{ route('login') }}">
                        {{ __('Not Me') }}
                      </a>
                      <button type="submit" class="col-4 float-right btn btn-sm btn-primary btn-hover">Log In</button>
                  </div>
                </form>
                <div class="signin-wrapper-footer">
                  <p class="bottom-text">Don’t have an account? <a href="{{ route('register') }}" data-toggle="modal" data-target="#signUpModal" data-dismiss="modal" aria-label="Close">Sign Up Now</a></p>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection
