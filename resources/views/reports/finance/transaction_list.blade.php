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
                <th>Address</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Fee</th>
                <th>Confirmations</th>
                <th>Txid</th>
                <th>Time</th>
            </tr>
            </thead>
            @foreach($transaction_list as $x => $transaction)
                <tr>
                    <td>{{ $x+1 }}</td>
                    <td><a href="https://www.blockchain.com/en/btc/address/{{$transaction['address']}}">{{ $transaction['address'] }}</a></td>
                    <td><span  class="{{ $transaction['category'] == 'send' ? 'text-danger' : 'text-primary'}}">{{ $transaction['category'] }}</span></td>
                    <td>{{ $transaction['amount'] }}</td>
                    <td>{{ $transaction['fee'] }}</td>
                    <td>{{ $transaction['confirmations'] }}</td>
                    <td>{{ $transaction['txid'] }}</td>
                    <td>{{ date("Y-m-d H:i:s", $transaction['txid']) }}</td>
                </tr>
            @endforeach
            <tfoot>
            </tfoot>
        </table>
    </div>
@endsection
