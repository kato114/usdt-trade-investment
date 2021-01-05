@extends('layouts.main')
@section('title')
    Administration
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">@yield('card-title')</h3>
            <div class="card-options">
                @yield('card-options')
            </div>
        </div>
        @yield('page')
    </div>
    @yield('other')
@endsection
