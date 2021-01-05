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
                    <div class="card-body">
                        <div class="card-header mb-5">{{ __('Choose ID') }}</div>
                        @foreach($users as $client)
                            <a href="{{ route('login.verify',['email' => $client->email,'guard' => $client->role]) }}">
                                <div class="form-group">
                                    <div class="media">
                                        <img class="mr-3" src="{{ $client->photo }}" style="width: 50px">
                                        <div class="media-body">
                                            <h5>{{ $client->name }}<span class="ml-2 badge badge-primary">@if($client->role == 'admin')
                                                        Admin @else Client @endif</span></h5>
                                            <h6>{{$client->phone}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        <div class="form-group">
                            <a class="btn btn-outline-primary" href="{{ route('login') }}">
                                {{ __('Not Me') }}
                            </a>
                        </div>
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
