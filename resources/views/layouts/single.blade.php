@extends('layouts.app')

@section('body')
    <style>
        .bg {
            background-size: cover;
            min-height: 100vh;
            background: white url({{ asset('images/background.jpg')}})  no-repeat;
        }
    </style>
    <div class="page bg">
        <div class="page-single mt-7">
            @yield('content')
        </div>
    </div>
@endsection
