@extends('layouts.signin')

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 30vh;">
            <div class="col col-login mx-auto">
                <div class="card">
                    <div class="card-header">{{ __('Your details have been received.') }}</div>
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ __('We will review your details and get back to you shortly') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        setTimeout(function(){
              window.location ='{{ url('https://25-percent.com/') }}';
        },5000)
    </script>
@append
