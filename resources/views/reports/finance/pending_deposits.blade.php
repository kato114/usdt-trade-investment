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
                <th>Amount USD</th>
                <th>Amount BTC</th>
                <th>Wallet</th>
            </tr>
            </thead>
            @foreach($query->get() as $x => $client)
                @foreach($client->deposits()->where('status','pending')->get() as $x => $deposit)
                    <tr>
                        <td>{{ $x+1 }}</td>
                        <td>
                            <a href="{{ route('client',['client' => $client,'action' =>'operations']) }}"> {{ $client->name }} </a>
                        </td>
                        <td>{{ $deposit->account->name }}</td>
                        <td>{{  currency( $deposit->usd) }}</td>
                        <td>{{  currency( $deposit->btc,true,8) }}</td>
                        <td>
                            <a href="https://www.blockchain.com/en/btc/address/{{$deposit->address}}">{{   $deposit->address }}</a>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            <tfoot>
            </tfoot>
        </table>
    </div>
@endsection
