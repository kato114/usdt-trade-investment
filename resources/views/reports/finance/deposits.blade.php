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
                <th>Deposits</th>
                <th>Profit %</th>
                <th>Balance</th>
            </tr>
            </thead>
            @php
                $deposits= \App\InvestorTransaction::query()->deposits() - \App\InvestorTransaction::query()->withdrawals();
                $balance =\App\InvestorTransaction::query()->balance()
            @endphp
            @foreach($query->get() as $x => $client)

                <tr>
                    <td>{{ $x+1 }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{  currency( $client->investorTransactions()->deposits() - $client->investorTransactions()->withdrawals()) }}</td>
                    <td>{{  currency( $client->commission) }}</td>
                    <td>{{  currency( $client->balance) }}</td>
                </tr>
            @endforeach
            <tfoot>
            <tr>
                <td colspan="2"></td>
                <td><b>Total Deposits</b></td>
                <td>{{ currency($deposits,true,2) }}</td>
                <td><b>Total Balance</b></td>
                <td>{{ currency($balance,true,2) }}</td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection
