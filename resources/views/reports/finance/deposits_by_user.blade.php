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
                <th>Accounts</th>
                <th>Balance</th>
            </tr>
            </thead>
            @php
                $balance= \App\InvestorTransaction::query()->deposits() -\App\InvestorTransaction::query()->withdrawals()
            @endphp

            @foreach($query->get() as $x => $user)

                <tr>
                    <td>{{ $x+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->clients()->count() }}</td>
                    <td>{{  currency( \App\InvestorTransaction::query()->whereIn('investor_id',$user->clients()->pluck('id'))->deposits() -\App\InvestorTransaction::query()->whereIn('investor_id',$user->clients()->pluck('id'))->withdrawals()) }}</td>
{{--                    <td>{{  currency( $client->balance) }}</td>--}}
                </tr>
            @endforeach
            <tfoot>
            <tr>
                <td colspan="2"></td>
                <td><b>Totals</b></td>
                <td>{{ currency($balance,true,2) }}</td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection
