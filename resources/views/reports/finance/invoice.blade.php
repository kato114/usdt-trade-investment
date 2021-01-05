@extends( 'layouts.reports')
@section('title')
    {{$report->title}}
    <a href="{{ route('report') }}"
       class="btn btn-info float-right">Back</a>
@endsection
@section('content')
    <div class="card">
        @if((clone $invoices)->count()>0)
            <table class="table card-table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="w-1">#</th>
                    <th>Invoice Number</th>
                    <th>Client</th>
                    <th>Profit</th>
                    <th>Commission %</th>
                    <th>Commission Amount</th>
                </tr>
                </thead>
                @foreach($invoices->cursor() as $x => $invoice)
                    <tr>
                        <td class="w-1">{{$x+1}}</td>
                        <td>
                            <a
                                    data-turbolinks="false"
                                    href="{{ route('invoice',['$invoice' => $invoice]) }}">{{$invoice->number}}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('client',['client' => $invoice->account->client]) }}">{{$invoice->account->client->name}}</a>
                        </td>
                        <td>{{ $invoice->account->currency }} {{$invoice->profit}}</td>
                        <td>{{currency(normalize($invoice->commission))}}</td>
                        <td>{{ $invoice->commission_currency }} {{currency($invoice->profit * $invoice->commission_fx)}}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="card-body">
                <div class="jumbotron bg-transparent">
                    <h4 class="text-center"> No invoices</h4>
                </div>
            </div>
        @endif
    </div>
@endsection