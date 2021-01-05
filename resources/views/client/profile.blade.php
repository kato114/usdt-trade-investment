@extends('layouts.main')
@section('title')
   {{ $client->name }}

@endsection
@section('content')

    <div class="row">

        <div class="modal fade " id="trade" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalTitle">Arbitrage Trade Example</h5>
                        <button type="button" class="text-white" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="m-9 d-flex justify-content-center ">
                            <img class="img-fluid" src="{{ asset('/images/arbitrage.jpg') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12  mb-5">
            <div class="card-tabs cusTabs">
                <span class="toggleTabs">Menu</span>
                <ul class="nav nav-tabs mx-0">
                    <li class="nav-item">
                        <a data-turbolinks="false"
                           href="{{route('client', ['client' => $client, 'action' => 'dashboard'])}}"
                           class="nav-link @if(request('action') == 'dashboard') active @endif">Dashboard</a>
                    </li>
                              <li class="nav-item">
                        <a data-turbolinks="false"
                           href="{{route('client', ['client' => $client, 'action' => 'overview'])}}"
                           class="nav-link @if(request('action') == 'overview') active @endif">Overview</a>
                    </li>
                  @if(user()->acting_role === 'admin')
                    <li class="nav-item">
                        <a data-turbolinks="false"
                           href="{{route('client', ['client' => $client, 'action' => 'referrals'])}}"
                           class="nav-link @if(request('action') == 'referrals') active @endif">Referrals</a>
                    </li>
                  
                  
                    <li class="nav-item">
                        <a data-turbolinks="false"
                           href="{{ route('client', ['client' => $client, 'action' => 'operations']) }}"
                           class="nav-link @if(request('action') == 'operations') active @endif">Operations</a>
                    </li>
                   <!-- <li class="nav-item">
                        <a data-turbolinks="false"
                           href="{{ route('client', ['client' => $client, 'action' => 'history']) }}"
                           class="nav-link @if(request('action') == 'history') active @endif">Account
                            History</a></li>-->
                 @endif
                    <li class="nav-item">
                        <a data-turbolinks="false"
                           href="{{ route('client', ['client' => $client, 'action' => 'wallet']) }}"
                           class="nav-link @if(request('action') == 'wallet') active @endif">Wallet</a>
                    </li>
                  
                    <li class="nav-item">
                        <a data-turbolinks="false"
                           href="{{ route('client', ['client' => $client, 'action' => 'transactions']) }}"
                           class="nav-link @if(request('action') == 'transactions') active @endif">Transactions</a>
                    </li>
                  
                    <li class="nav-item">
                        <a data-turbolinks="false"
                           href="{{ route('client', ['client' => $client, 'action' => 'beneficiary']) }}"
                           class="nav-link @if(request('action') == 'beneficiary') active @endif">Beneficiary</a>
                    </li>
                    <li class="nav-item">
                        <a data-turbolinks="false"
                           href="{{ route('client', ['client' => $client, 'action' => 'calculator']) }}"
                           class="nav-link @if(request('action') == 'calculator') active @endif">Profit
                            Calculator</a>
                    </li>
                      <li class="nav-item">
                        <a data-turbolinks="false"
                           href="{{ route('client', ['client' => $client, 'action' => 'mailbox']) }}"
                           class="nav-link @if(request('action') == 'mailbox') active @endif">Contact Us</a>
                    </li>
                   <!-- <li class="nav-item">
                        <a href="#"
                           data-toggle="modal" data-target="#trade"
                           class="nav-link">Trade Example</a>
                    </li>-->
                   @if(user()->acting_role === 'admin')
                        @php
                            $recipients = base64_encode(json_encode([$client->email]));
                            session()->put('url.intended', URL::full());
                        @endphp
                        <li class="nav-item">
                            <a data-turbolinks="false"
                               href="{{route('mailbox', compact('recipients'))}}"
                               class="nav-link">Send
                                Email</a>
                        </li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        @if(request('action') == 'dashboard')
                            @include('client.account')
                        @endif
                           @if(request('action') == 'overview')
                            @include('client.overview')
                        @endif
                          @if(request('action') == 'mailbox')
                            @include('client.mailbox')
                        @endif
                        @if(request('action') == 'calculator')
                            @include('client.calculator')
                        @endif
                        @if(request('action') == 'history')
                            @include('client.history')
                        @endif
                        @if(request('action') == 'wallet')
                            @include('client.wallet')
                        @endif
                        @if(request('action') == 'status')
                            @include('client.status')
                        @endif
                  
                     @if((user()->role =='admin'))
                        @if(request('action') == 'referrals')
                            <div class="card">
                                <div class="card-header">
                                   <div class="card-title">Listing</div>
                                    <div class="card-options">
                                        <a href="#" data-toggle="modal" data-target="#referral"
                                           class="btn btn-primary btn-sm p-2 mr-2" style="
                                                background-color: white;
                                                color: black;
                                            ">How it works
                                            <span>&#63</span>
                                        </a>
                                      
                                            <a href="{{ route('referral',compact('client')) }}"
                                               class="btn btn-primary" style="
                                                background-color: white;
                                                color: black;
                                            ">Add</a>
                                     
                                    </div>
                                </div>

                                @if($client->referrals()->count()>0)
                                    <table class="table card-table table-striped border-0">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($client->referrals as $referral)
                                            <tr>
                                                <td>
                                                    {{ $referral->client->name }}
                                                </td>
                                                <td>{{ $referral->client->email }}</td>
                                                <td>
                                                    @if(user()->role =='admin')
                                                        <a class="btn btn-danger btn-sm"
                                                           href="{{ route('referral',['client' => $client,'action' => 'delete','referral' => $referral]) }}">Remove</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="empty text-center">
                                        <div class="empty-icon mt-5" style="font-size: 32px">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70"
                                                 viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round" class="">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                                                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                                <line x1="15" y1="9" x2="15.01" y2="9"></line>
                                            </svg>
                                        </div>
                                        <p class="empty-title h3">None as yet.</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                           @endif
                        @if(request('action') == 'transactions')
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Recent Transactions</h3>
                                </div>
                              @php $transactions = $client->transactions()->orderByDesc('date')->paginate(1500); @endphp
                                @if($transactions->count()>0)
                                              <!-- datatable css and js start -->
                                        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                                        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
                                        <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
                                        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                                        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
                                        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

                                        <!-- datatable css and js code end -->
                                    <h5 id="transactions" class="p- m-0 bg-primary"></h5>
                                    <table id="example" class="table table-striped card-table m-0">
                                        <thead>
                                        <tr>
                                            {{--                    <td><b>Account</b></td>--}}
                                            <th><b>Narration</b></th>
                                            <th><b>Amount</b></th>
                                             <th><b>%</b></th>
                                            <th><b>Date (GMT)</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transactions as $transaction)
                                        @php
                                            $pBalance = $client->balanceDWP($transaction->date);
                                        @endphp
                                            <tr>
                                                {{-- <td><b>{{ strtoupper( $transaction->account->name)}}</b></td>--}}
                                                <td class="wrap"
                                                    title="{{ strtoupper( $transaction->narration) }}">{{ strtoupper( $transaction->narration) }}</td>
                                                <td>{{ currency($transaction->amount,true,2) }}</td>
                                                <td>
                                                    @if($transaction->type == 'profit')
                                                    {{ round($pBalance == 0? 0 : $transaction->amount / $pBalance * 100,2) }}
                                                    @endif
                                                </td>
                                                <td>{{ date('D d-M-yy', strtotime($transaction->date)) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div
                                        class="p-5">{{ $transactions->fragment('transactions')->appends(['action' => 'transactions'])->render() }}</div>
                                @else
                                    <div class="jumbotron text-center">
                                        No transactions
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if(request('action') == 'operations')
                            <div class="card">
                                @if((user()->acting_role =='admin'))
                                    @php $transactions = $client->deposits()->where('status','pending')->orderByDesc('created_at')->paginate(); @endphp
                                    @if($transactions->count()>0)
                                        <h5 id="transactions">Recent Operations [Deposits]</h5>
                                        <table class="table card-table table-striped">
                                            <thead>
                                            <tr>
                                                <td><b>Wallet Address</b></td>
                                                <td><b>Amount USD</b></td>
                                                <td><b>Amount BTC</b></td>
                                                <td><b>Status</b></td>
                                                <td><b>Date (GMT)</b></td>
                                                <td></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($transactions as $transaction)
                                                <tr>
                                                    <td class="wrap"
                                                        title="{{ strtoupper( $transaction->address) }}">{{ strtoupper( $transaction->address) }}</td>
                                                    <td>{{ currency($transaction->usd,true,2) }}</td>
                                                    <td>{{ currency($transaction->btc,true,8) }}</td>
                                                    <td>{{ $transaction->status }}</td>
                                                    <td>{{ $transaction->created_at }}</td>
                                                    <td>
                                                        <div class="dropdowns">
                                                            <a href="javascript:void(0)" data-toggle="dropdown" class="" aria-expanded="false">@icon('more-vertical')</a>
                                                            <div class="dropdown-menu dropdown-menu-right"
                                                                 x-placement="bottom-end">
                                                                <a href="{{ route('client',['action' => 'operations','role' => 'approval','client' => $client,'operation' => $transaction]) }}"
                                                                   class="dropdown-item"><i
                                                                        class="dropdown-icon fe fe-check-circle">
                                                                    </i> Approve </a>
                                                                <a href="{{  route('client',['action' => 'operations','role' => 'rejection','client' => $client,'operation' => $transaction]) }}"
                                                                   class="dropdown-item"><i
                                                                        class="dropdown-icon fe fe-trash">
                                                                    </i> Reject </a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <hr>
                                    @else

                                    @endif
                                    @php $transactions = $client->withdrawalrequests()->where('status','pending')->orderByDesc('created_at')->paginate(); @endphp

                                    @if($transactions->count()>0)
                                        <h5 id="transactions">Recent Operations [Withdrawals]</h5>
                                        <table class="table card-table table-striped">
                                            <thead>
                                            <tr>
                                                <td><b>Destination</b></td>
                                                <td><b>Amount USD</b></td>
                                                <td><b>Status</b></td>
                                                <td><b>Date (GMT)</b></td>
                                                <td></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($transactions as $transaction)
                                                <tr>
                                                    <td>{!!  $transaction->withdrawNarration !!}</td>
                                                    <td>{{ currency($transaction->amount,true,2) }}</td>
                                                    <td>{{ $transaction->status }}</td>
                                                    <td>{{ $transaction->created_at }}</td>
                                                    <td>
                                                        <div class="dropdowns">
                                                            <a href="javascript:void(0)" data-toggle="dropdown" class="" aria-expanded="false">@icon('more-vertical')</a>
                                                            <div class="dropdown-menu dropdown-menu-right"
                                                                 x-placement="bottom-end">
                                                                <a href="{{ route('client',['action' => 'operations','w' =>true,'role' => 'approval','client' => $client,'operation' => $transaction]) }}"
                                                                   class="dropdown-item"><i
                                                                        class="dropdown-icon fe fe-check-circle">
                                                                    </i> Approve </a>
                                                                <a href="{{  route('client',['action' => 'operations','w' =>true, 'role' => 'rejection','client' => $client,'operation' => $transaction]) }}"
                                                                   class="dropdown-item"><i
                                                                        class="dropdown-icon fe fe-trash">
                                                                    </i> Reject </a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                    @endif
                                @endif

                                <div class="card-header border-0">
                                    <h3 class="card-title bg-azure-light"> Operations
                                      <small class="">
                                            <br>
                                            This page is temporally unavailable, we are working on a more reliable solution.
                                        </small>
                                    </h3>
                                </div>
                            </div>
                        @endif
                        @if(request('action') == 'beneficiary')
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title"> Beneficiary Details </h3>
                                </div>
                                <div class="card-body col-6">
                                    <form method="post">
                                        @csrf
                                        <p>I here by nominate the following individual to be my rightful BENEFICIARY
                                            of
                                            my
                                            account
                                            upon my death.</p>
                                        <div class="form-group">
                                            <label class="col-form-label">Name:</label>
                                            <input type="text" name="name" value="{{ $client->payload->name }}"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Relationship:</label>
                                            <input type="text" name="relationship"
                                                   value="{{ $client->payload->relationship }}"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Email:</label>
                                            <input type="text" name="email" value="{{ $client->payload->email }}"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Phone Number:</label>
                                            <input type="text" name="phone" value="{{ $client->payload->phone }}"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-check form-check-highlight">
                                                <input class="form-check-input" required type="checkbox">
                                                <div class="form-check-label">
                                                    I confirm that the aforesaid nomination instruction is made by
                                                    me,
                                                    as the
                                                    account owner of this account.
                                                </div>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" style="
                                            color: white;
                                        ">Update Details</button>
                                        </div>
                                        <p class="text-info"><small>This page can be updated at any time.</small>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="referral" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalTitle">How our referral works</h5>
                        <button type="button" class="text-white " data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            1) In order to qualify for referrals, you must have a minimum balance in your account of
                            $50,000
                        </p>
                      
                        <p>
                            2) Commission Structure: A 5% commission is paid to you from every profit your referee
                            makes.
                        </p>
                        <p>
                            3) In order to qualify for commission the new member must fund their account with a minimum
                            of
                            $10,000
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @if(user()->role == 'admin')
            <div class="modal fade" id="transaction" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('transaction',compact('client')) }}">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitle">Transaction</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <input type="hidden" name="operation" id="adminoperation" value="deposit">
                            <div class="modal-body">
                                @csrf
                                <div class="form-group">
                                    <label class="col-form-label">Amount:</label>
                                    <input type="number" name="amount" step="0.00000001" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Account:</label>
                                    <select class="form-select" name="account_id">
                                        @foreach(\App\Account::all() as $account)
                                            <option value="{{ $account->id }}">{{$account->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    {{ date_picker('Date','date', now()->toDateTimeString()) }}
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                </button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('scripts')
 <script src="https://code.jquery.com/jquery-latest.js"></script>

    <script>
        $('[data-toggle="card-collapse"]').on('click', function (e) {
            const DIV_CARD = 'div.card';

            let $card = $(this).closest(DIV_CARD);

            $card.toggleClass('card-collapsed');

            e.preventDefault();
            return false;
        });

        function performTransaction() {
            $('#transaction').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var operation = button.data('type');
                var modal = $(this);

                if (operation === 'withdraw') {
                    modal.find('.modal-title').text('Client Withdrawal');
                } else {
                    modal.find('.modal-title').text('Client Deposit');

                }

                modal.find('.modal-content input[name=operation]').val(operation);
            })
        }

        performTransaction();
    </script>
    	<script>
	
	  setInterval("my_function();",30000); 
    function my_function(){
    //  $('#refresh456').load('https://arbitrage-trading.io/public/client/44/deposits').fadeIn(30000);
	
    }

</script>

@if(request('action') == 'transactions')
<script>
$(document).ready(function() {

    $.noConflict();
    $('#example').DataTable({
        dom: 'lBfrtip',
      "pageLength": 10,
      "iDisplayLength": 10,
       "bSort" : false,
      "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );
</script>
@endif
@append
