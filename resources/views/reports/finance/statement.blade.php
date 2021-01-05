@extends( 'layouts.reports')
@section('title')
    @if(isset($account))
        {{$report->title}} ({{$account->name}})
    @else
        {{$report->title}}
    @endif
    @if(isset($transactions))
        {{ date_range($from,$to) }}
    @endif
    <a href="{{ isset($account) ? route('client',['client' => $account->client]) : route('report') }}"
       class="btn btn-info float-right">Back</a>
@endsection
@section('content')
    @if(!isset($transactions))
        <div class="card">
            <div class="card-header">
                Statement Duration
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-xl-4 col-md-6 col-sm-12">
                        <form action="" method="get" class="form-horizontal">
                            <div class="form-group">
                                <label>Select Period</label>
                                <select class="form-control" id="date_selector">
                                    <option value="custom">Custom</option>
                                    @php
                                        $next = now()->addMonth()->firstOfMonth(\Carbon\Carbon::SATURDAY)
                                    @endphp
                                    @foreach($dates as $date)
                                        <option value="{{$date->toDateTimeString()}}|{{$next->endOfDay()->toDateTimeString()}}">{{ $date->format('F Y') }}</option>
                                        @php
                                            $next = $date;
                                        @endphp
                                    @endforeach
                                </select>
                            </div>
                            <div id="dates">
                                {{date_picker('From', 'from',coalesce($from,now()->startOfDay()))}}
                                {{date_picker('Date To', 'to',now()->endOfDay())}}
                            </div>
                            @if(isset($account))
                                <input type="hidden" name="account" value="{{ $account->id }}">
                            @endif
                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
                                <a href="{{user()->role =='admin' ? url('reports') : route('client',['client' => $account->client]) }}" class="btn btn-outline-primary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if(isset($account))
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <span class="avatar avatar-xxl mr-5"
                                      style="background-image: url({{ $account->client->photo }})"></span>
                                <div class="media-body">
                                    <h4 class="m-0">{{ $account->client->name }}</h4>
                                    <p class="text-muted mb-0">{{ $account->client->club }}</p>
                                    <a class="mb-0 wrap"
                                       href="mailto:{{ $account->client->email }}">{{ $account->client->email }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="text-right text-red">
                                &nbsp;
                            </div>
                            <div class="h1 m-0">{{ currency(normalize( (clone $transactions)->profit()),true,0) }}</div>
                            <div class="text-muted mb-5">Profit</div>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="text-right text-red">
                                &nbsp;
                            </div>
                            <div class="h1 m-0">{{ currency(normalize( (clone $transactions)->deposits()->sum('profit')),true,0) }}</div>
                            <div class="text-muted mb-5">Deposit</div>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="text-right text-red">
                                &nbsp;
                            </div>
                            <div class="h1 m-0">{{ currency(normalize( (clone $transactions)->withdrawals()->sum('profit')),true,0) }}</div>
                            <div class="text-muted mb-5">Withdrawal</div>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="text-right text-red">
                                &nbsp;
                            </div>
                            <div class="h1 m-0">{{ currency(normalize( $account->balance),true,0) }}</div>
                            <div class="text-muted mb-5">Balance</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="card">
            @if((clone $transactions)->count()>0)
                <table class="table card-table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="w-1">#</th>
                        <th>Ticket</th>
                        <th>Type</th>
                        <th>Item</th>
                        <th>Commission</th>
                        <th>Swap</th>
                        <th>Profit/Amount</th>
                        <th>Closed At</th>
                    </tr>
                    </thead>
                    @foreach($transactions->cursor() as $x => $transaction)
                        <tr>
                            <td class="w-1"><i>{{$x+1}}</i></td>
                            <td>{{$transaction->ticket}}</td>
                            <td>{{ ucfirst( $transaction->type) }}</td>
                            <td>{{ strtoupper($transaction->item) }}</td>
                            <td>{{currency(normalize($transaction->commission))}}</td>
                            <td>{{currency(normalize($transaction->swap))}}</td>
                            <td>{{currency(normalize($transaction->profit))}}</td>
                            <td>{{$transaction->closed_at->toDateTimeString()}}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                <div class="card-body">
                    <div class="jumbotron bg-transparent">
                        <h4 class="text-center"> No transactions in this period</h4>
                    </div>
                </div>
            @endif
        </div>
    @endif
@endsection
@section('scripts')
    <script>
        $(document).on('turbolinks:load', function () {
          loadStuff()
        });

        $(document).ready(function () {
           loadStuff();
        });
        function loadStuff() {
            $('#date_selector').on('change', function () {
                if ($(this).val() === 'custom') {
                    $('#dates').removeClass("d-none");
                } else {
                    // $('#dates').addClass("d-none");
                    var dates = $(this).val().split("|");
                    $('input[name=from]').val(dates[0]);
                    $('input[name=to]').val(dates[1]);
                }
            });
            setTimeout(function(){
                $('#date_selector option:eq(1)').attr('selected', 'selected')
                var dates =$('#date_selector').val().split("|");
                $('input[name=from]').val(dates[0]);
                $('input[name=to]').val(dates[1]);
            },1000);
        }
    </script>
@endsection