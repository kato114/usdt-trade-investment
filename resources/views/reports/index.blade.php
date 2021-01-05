@extends('layouts.main')
@section('styles')
    <style>
        @page {
            size: landscape !important;
        }
    </style>
@endsection
@section('title')
    Reports
@endsection
@section('content')
@if((user()->role == 'admin' && user()->acting_role === 'admin'))
    <div class="card">
        <div class="card-header">
            {{ucfirst( user()->acting_role)}} Reports
        </div>
        <div class="card-body">
            <div class="col-12 p-0 mt-3">
                @foreach($reports as $report)
                <?php //print_r($report->slug);
                if($report->slug=='client_deposits_by_user')
                {
                    // break;
                }
                else
                {
                ?>
                    @if(!in_array($report->slug,['account_statement','account_ftp_statement']))
                        <a class="btn btn-outline-primary mr-1 mt-1"
                           href="{{ route('report',['report' => $report->slug]) }}">{{$report->title}}</a>
                    @endif
                    <?php
                }
                ?>
                @endforeach
            </div>
        </div>
    </div>
@else
<div class="card">
        <div class="card-header">
            Manager Reports
        </div>
        <div class="card-body">
            <div class="col-12 p-0 mt-3">
                                                            <a class="btn btn-outline-primary mr-1 mt-1" href="https://arbitrage-trading.io/public/reports/admin_listing">Admin Listing</a>
                                                                                <a class="btn btn-outline-primary mr-1 mt-1" href="https://arbitrage-trading.io/public/reports/client_listing">Client Listing</a>
                                                                                                                    <a class="btn btn-outline-primary mr-1 mt-1" href="https://arbitrage-trading.io/public/reports/client_deposits">Client Deposits</a>
                                                                                
                                                </div>
        </div>
    </div>
@endif
@endsection
@section('scripts')
@endsection