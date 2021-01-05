@extends('layouts.single')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-login mx-auto">
                <div class="text-center mb-6">
                    <img src="{{ asset('images/logo.svg') }}" class="h-6" alt="">
                </div>
                <form method="POST" class="card" action="{{ route('verification.verify.phone') }}">
                    @csrf
                    <div class="card-body p-6">
                        <div class="card-title">{{ __('Verify Your Phone Number') }}</div>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A new verification code has been sent to your phone number.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your phone for a verification code.') }}
                        {{ __('If you did not receive the code') }}, <a
                                href="{{ route('verification.resend.phone') }}">{{ __('click here to request another') }}</a>.
                        <br>
                        <div class="form-group">
                            <label class="form-label">
                                Verification Code
                            </label>
                            <input style="font-size: 36px" id="password" type="password"
                                   class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                   name="code" required>

                            @if ($errors->has('code'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block"> {{ __('Verify') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
