@extends('layouts.main')
@section('title')
    Send Invoices
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Details</h3>
            <div class="card-options">
                <a href="{{ route('report') }}" class="btn btn-primary btn-sm">Back</a>
            </div>
        </div>
        <div class="card-body">
            <form method="post">
                @csrf
                <div class="form-label">Currency Exchange Rates (THB)</div>
                <div class="row">
                    @foreach($currencies as $currency)
                        <div class="form-group col-2">
                            <label class="form-label">
                                {{ $currency }}
                            </label>
                            <input name="{{ $currency }}" type="text"
                                   class="form-control"
                                   value="{{ $rates[$currency] }}">
                        </div>
                    @endforeach
                </div>
                <button class="btn btn-primary">Send Invoices</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
