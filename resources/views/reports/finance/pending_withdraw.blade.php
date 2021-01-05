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
                <th>Withdraw Type</th>
                <th>Amount USD</th>
				<th>Bitcoin Wallet</th>
				<th>Bank Name</th>
				<th>Bank Address</th>
				<th>client_address</th>
				<th>swift_code</th>
				<th>bank_account</th>
				<th>email</th>
				<th>date</th>
            </tr>
            </thead>
            @foreach($query->get() as $x => $client)
                @foreach($client->withdrawalRequests()->where('status','pending')->get() as $x => $withdraw)
				<?php //die(print_r($withdraw->withdraw_type));?>
                    <tr>
                        <td>{{ $x+1 }}</td>
                        <td>
                            <a href="{{ route('client',['client' => $client,'action' =>'operations']) }}"> {{ $client->name }} </a>
                        </td>
                        <td>{{ $withdraw->withdraw_type }}</td>
                        <td>{{  currency( $withdraw->amount) }}</td>
						 <td>{{  $withdraw->wallet }}</td>
                        <td>{{ $withdraw->bank_name }}</td>
						<td>{{ $withdraw->bank_address }}</td>
						<td>{{ $withdraw->client_address }}</td>
						<td>{{ $withdraw->swift_code }}</td>
						<td>{{ $withdraw->bank_account }}</td>
						<td>{{ $withdraw->email }}</td>
						<td>{{ $withdraw->created_at }}</td>
                        
                    </tr>
                @endforeach
            @endforeach
            <tfoot>
            </tfoot>
        </table>
    </div>
@endsection
