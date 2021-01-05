@extends( 'layouts.reports')
@section('title')
    {{$report->title}}
    @if(isset($transactions))
        {{ date_range($from,$to) }}
    @endif
    <a href="{{ route('report') }}"
       class="btn btn-info float-right">Back</a>
@endsection
@section('content')
    @if(!isset($accounts))
        <div class="card">
            <div class="card-header">
                Statement Period
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-xl-4 col-md-6 col-sm-12">
                        <form action="" method="get" class="form-horizontal">
                            <div class="form-group">
                                <label>Select Period</label>
                                <select class="form-select" id="date_selector">
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
                            @if(user()->club =='*')
                                <div class="form-group">
                                    <label>Select Clubs</label>
                                    <br>
                                    <div class="selectgroup selectgroup-pills">
                                        @foreach($clubs as $club)
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="value[]" value="{{ $club }}"
                                                       class="selectgroup-input"
                                                       checked="">
                                                <span class="selectgroup-button">{{ $club }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
                                <a href="{{url('reports')}}" class="btn btn-outline-primary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card">
            @if((clone $accounts)->count()>0)
                <form method="post"
                      action="{{ route('commission',['action'=>'send','from' =>$from->toDateTimeString(),'to' =>$to->toDateTimeString()]) }}">
                    <table class="table card-table table-striped table-bordered datatable">
                        <thead>
                        <tr>
                            <th>Client</th>
                            <th>Account</th>
                            <th>Profit</th>
                            <th>Commission %</th>
                            <th>Commission</th>
                            <th>IN USD</th>
                            @if(user()->club =='*')
                                <th>
                                    <label class="custom-control m-0 custom-checkbox custom-control-inline">
                                        <input type="checkbox" id="send" class="custom-control-input" checked="">
                                        <span class="custom-control-label">Send</span>
                                    </label>
                                </th>
                            @endif
                        </tr>
                        </thead>
                        @php
                            $total = ['profit' =>0,'commission' => 0];
                        @endphp
                        @foreach($accounts->cursor() as $x => $account)
                            <tr>
                                <td>
                                    <a href="{{ route('client',['client' => $account->client]) }}">{{$account->client->name}}</a>
                                </td>
                                <td class="wrap">{{$account->account}} - {{$account->name}} </td>
                                @php
                                    $profit =  $account->transactions()->whereBetween('closed_at',[$from,$to])->profit();
                                    $commission = $account->commission * $profit/100;
                                    $total['profit'] += $profit * 1/$rates[$account->currency];
                                @endphp
                                <td data-order="{{$profit * 1/$rates[$account->currency] }}">{{ $account->currency }} {{currency(normalize($profit))}}</td>
                                <td class="text-right">{{$account->commission}}%</td>
                                <td data-order="{{$commission * 1/$rates[$account->currency] }}">{{ $account->currency }} {{currency(normalize($commission))}}</td>
                                <td data-order="{{$commission * 1/$rates[$account->currency] }}">{{currency(normalize($commission * 1/$rates[$account->currency]))}}</td>
                                @php
                                    $total['commission']  += $commission * 1/$rates[$account->currency];
                                @endphp
                                @if(user()->club =='*')
                                    <td>
                                        <label class="custom-control m-0 custom-checkbox custom-control-inline">
                                            <input type="checkbox" name="account[]" value="{{ $account->id }}"
                                                   class="send custom-control-input" checked="">
                                            <span class="custom-control-label">&nbsp;</span>
                                        </label>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        <tfoot>
                        <tr>
                            <th class="w-1" colspan="2">Totals</th>
                            <th colspan="2">
                                USD {{currency(normalize($total['profit']))}}
                            </th>
                            <th colspan="3">USD {{currency(normalize($total['commission']))}}</th>
                        </tr>
                        </tfoot>
                    </table>
                    @if(user()->club =='*')
                        <div class="card-body">
                            <button class="btn btn-primary float-right">Prepare Invoices</button>
                            <div class="clearfix"></div>
                        </div>
                        @csrf
                    @endif
                </form>
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
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script>
        $(document).on('turbolinks:load', function () {
            loadStuff();
            @if( isset ($accounts))
            $('.datatable').DataTable({
                paging: false,
                searching: false
            });
            @endif
        });

        $(document).ready(function () {
            loadStuff();
        });

        function loadStuff() {

            $('#send').on('change', function () {
                $('.send').prop("checked", $(this).prop("checked"));
            });
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
            setTimeout(function () {
                $('#date_selector option:eq(2)').attr('selected', 'selected');
                var dates = $('#date_selector').val().split("|");
                $('input[name=from]').val(dates[0]);
                $('input[name=to]').val(dates[1]);
            }, 1000);
        }
    </script>
@endsection
