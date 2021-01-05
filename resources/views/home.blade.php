@extends('layouts.main')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="mx-0">
        <table class="table">
            <tr>
                <td colspan="1" class="border-0 pl-0">
                    <div class="card mx-0">
                        <div class="card-body p-3 text-center">
                            <div class="text-right text-green">
                                &nbsp;
                            </div>
                            <div class="h1 m-0">{{ now()->toTimeString() }}</div>
                            <div class="text-muted mb-4">Server Time (GMT)</div>
                        </div>
                    </div>
                </td>
                <td colspan="1" class="border-0">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="text-right text-green">
                                &nbsp;
                            </div>
                            <div class="h1 m-0">{{ currency($clients->count(),true,0,true) }}</div>
                            <div class="text-muted mb-4">Clients</div>
                        </div>
                    </div>
                </td>
                <td colspan="2" class="border-0">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="text-right">
                                &nbsp;&nbsp;USD
                            </div>
                            <div class="h1 m-0">{{ currency($totalFund,true,2) }}</div>
                            <div class="text-muted mb-4">Total Club Fund</div>
                        </div>
                    </div>
                </td>
                @foreach($periods as $x => $period)
                    <td colspan="2" class="border-0">
                        <div class="card">
                            <div class="card-body p-3 text-center">
                                <div class="text-right">
                                    &nbsp;&nbsp;USD
                                </div>
                                @php
                                    $profit  =  App\Transaction::query()->whereBetween('date', [$period->start, $period->end])->profit();
                                @endphp
                                <div class="h1 m-0">{{ currency($profit,true,2,!true) }}</div>
                                <div class="text-muted mb-0"> Profit ({{ $period->name }})</div>
                                <div class="text-danger" style="margin-top: 13px; margin-bottom: -18px;">
                                    <h3><strong>Auto Profit Value : {{ number_format(\App\Options::where('opt_key', '=', 'auto_profit')->first()->opt_value,2) }}</strong></h3>
                                </div>
                            </div>
                        </div>
                    </td>
                @endforeach
                <td colspan="2" class="border-0 pr-0">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="text-right">
                                &nbsp;&nbsp;USD
                            </div>
                            <div class="h1 m-0">{{ currency($deposits,true,2,!true) }}</div>
                            <div class="text-muted mb-4"> Total Deposits</div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <div class="card">
            <table class="table table-striped card-table">
                <thead>
                <tr>
                    <th><b>Ticket</b></th>
                    <th><b>Type</b></th>
                    <th><b>Amount</b></th>
                    <th><b>Date (GMT)</b></th>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Transaction::query()->orderByDesc('date')->paginate(20) as $interest)
                    <tr>
                        <td><b>{{  $interest->ticket }}                    </b></td>
                        <td><b>{{ $interest->type }}</b></td>
                        <td><b>{{ currency( $interest->amount,true,2) }}</b></td>
                        <td><b>{{ date('D d-M-yy', strtotime($interest->date)) }}</b></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
