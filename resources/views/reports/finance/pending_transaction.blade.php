@extends( 'layouts.reports')
@section('title')
    {{$report->title}}
    <a href="{{ route('report') }}"
       class="btn btn-info float-right">Back</a>
@endsection
@section('content')
    <div class="card">
        <table class="table card-table table-striped table-bordered datatable">
            <thead>
            <tr>
                <th>#</th>
                <th>Client</th>
                <th>Account</th>
                <th>Wallet Address</th>
                <th>Requested USD</th>
                <th>Requested BTC</th>
                <th>Confirmed Amount</th>
                <th>Date (GMT)</th>
                <th>Request Status</th>
            </tr>
            </thead>
            @foreach($deposit->get() as $x => $client)
                @foreach($client->deposits()->where('status','pending')->get() as $x => $deposit)
                    <tr>
                        <td>{{ $x+1 }}</td>
                        <td>
                            <a href="{{ route('client',['client' => $client,'action' =>'operations']) }}"> {{ $client->name }} </a>
                        </td>
                        <td>{{ $deposit->account->name }}</td>
                        <td><a href="https://www.blockchain.com/en/btc/address/{{$deposit->address}}">{{ $deposit->address }}</a></td>
                        <td>{{ currency($deposit->usd,true,2) }}</td>
                        <td class="text-danger">{{ currency($deposit->btc,true,8) }}</td>
                        <td class="text-primary">{{ currency($deposit->rbtc,true,8) }}</td>
                        <td>{{ $deposit->created_at }}</td>
                        <td>{{ $deposit->status }}</td>
                    </tr>
                @endforeach
            @endforeach
            <tfoot>
            </tfoot>
        </table>
    </div>

    <div class="card">
        <table class="table card-table table-striped table-bordered datatable">
            <thead>
            <tr>
                <th>#</th>
                <th>Client</th>
                <th>Wallet Address</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            </thead>
            @foreach($withdraw->get() as $x => $client)
                @foreach($client->withdrawalRequests()->where('status','pending')->get() as $x => $withdraw)
				<?php //die(print_r($withdraw->withdraw_type));?>
                    <tr>
                        <td>{{ $x+1 }}</td>
                        <td>
                            <a href="{{ route('client',['client' => $client,'action' =>'operations']) }}"> {{ $client->name }} </a>
                        </td>
                        <td><a href="https://www.blockchain.com/en/btc/address/{{$withdraw->address}}">{{ $withdraw->wallet }}</a></td>
                        <td>{{ currency($withdraw->amount,true,2) }}</td>
                        <td>{{ $withdraw->created_at }}</td>
                        <td>{{ $withdraw->status }}</td>
                    </tr>
                @endforeach
            @endforeach
            <tfoot>
            </tfoot>
        </table>
    </div>
@endsection
