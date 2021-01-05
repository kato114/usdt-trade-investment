@extends( 'layouts.main')
@section('styles')
    <style>
        @page {
            size: landscape !important;
        }
    </style>
@endsection
@section('title')
    {{$report->title}} <a href="{{ route('report') }}" class="btn btn-info float-right">Back</a>
@endsection
@section('content')
    <div class="card">
        <table class="table card-table table-striped table-bordered">
            <thead>
            <tr>
                <td>#</td>
                <th>Exchange</th>
                <th>Item</th>
                <th>Type</th>
                <td>Price</td>
                <th>Quantity</th>
                <td>Total</td>
                <td>Time</td>
            </tr>
            </thead>
            <tbody>
            @foreach($trades as $x => $trade)
                <tr>
                    <td>{{ $trade->trade_id }}</td>
                    <td>{{ $trade->exchange }}</td>
                    <td>{{ $trade->currency }}</td>
                    <td>{{ $trade->type }}</td>
                    <td>{{ normalize( currency( $trade->price,true,6)) }}</td>
                    <td>{{ normalize( $trade->quantity) }}</td>
                    <td>{{ normalize( number_format( $trade->total,4)) }}</td>
                    <td>{{$trade->date->toDateTimeString()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $trades->render() }}
@endsection