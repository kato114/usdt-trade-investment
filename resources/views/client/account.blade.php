<div class="card">
    <div class="card-status bg-teal"></div>
    <div class="card-header" style="
    background: white;
">
        <h3 class="card-title"> Current Fund value: $
            {{currency( normalize( $client->balance),true,2)}}
        </h3>
        <div class="card-options">
            <span
                class="pt-1 mr-2 card-title  d-inline-block"> Account Opened: {{ $client->opened_at->format('jS M Y') }}</span>
           @if((user()->role == 'admin' && user()->acting_role === 'admin'))
           <div class="btnWraper">
                <a class="btn btn-success mr-4" href="{{ route('client', ['client' => $client, 'action' => 'wallet']) }}">Deposit</a>
                <a class="btn btn-primary mr-4" href="{{ route('client', ['client' => $client, 'action' => 'wallet']) }}">Withdraw</a>
                   </div>
            @else
            @if(user()->acting_role != 'admin' && user()->acting_role != 'manager')
            <div class="btnWraper">
                <a class="btn btn-success mr-4" href="{{ route('client', ['client' => $client, 'action' => 'wallet']) }}">Deposit</a>
                <a class="btn btn-primary mr-4" href="{{ route('client', ['client' => $client, 'action' => 'wallet']) }}">Withdraw</a>
                </div>
                   @endif
            @endif
        </div>
    </div>
    <div class="card-body">
          <div class="row">
                            <div class="col-md-3 col-sm-12">
                              @foreach($periods as $period)
                              <div class="row" style="margin-left: 0px; margin-right: 0px;">
                                 <div class="card col-md-7" style="border-color: white;background-color: #f80844;border-radius: 12px;">
                                    <div class="card-body" style="font-size: larger;padding: 0.75rem 0rem;">
                                        <h3 class="mb-1 text-white text-center">{{ currency( normalize( $client->transactions()->where('type','profit')->whereBetween('date',[$period->start, $period->end])->profit()),true,2,false) }}</h3>
                                        <div class="text-muted text-center text-white" title="{{ date_range($period->start,$period->end) }}">
                                          Profit
                                        </div>
                                    </div>
                                </div>
                                 <div class="card col-md-5" style="border-color: white;background-color: #f80844;border-radius: 12px;">
                                    <div class="card-body" style="font-size: larger;padding: 0.75rem 0rem;">
                                        <h3 class="mb-1 text-white text-center">
                                            @php 
                                                $percent = 0;
                                                $transactions = $client->transactions()->where('type', '!=', 'profit')->orderby('date')->get();
                                            
                                                foreach($transactions as $key => $transaction)
                                                {
                                                  $deposit = $client->balanceDWP($transaction->date);
                                            
                                                  $nprofit = isset($transactions[$key + 1]) ? $client->profitAt($transactions[$key + 1]->date) : $client->profitAt(now());
                                                  $cprofit = $client->profitAt($transaction->date);
                                            
                                                  $percent += ($nprofit - $cprofit) / $deposit * 100;
                                                }
                                            @endphp
                                            {{ currency( $percent ,true,2) }}</h3>
                                        <div class="text-muted text-center text-white" title="{{ date_range($period->start,$period->end) }}">
                                          %
                                        </div>
                                    </div>
                                </div>
                            </div>
                             @endforeach   
                          <div class="card bg-orange" style="border-color: white; border-radius: 12px">
                    <div class="card-body" style="font-size: larger;padding: 0.75rem;">
                         <?php
                      $x = $client->transactions()->deposits() - $client->transactions()->withdrawals();
                      
                      if($x==0)
                      {
                        $tval="My Contributions";
                        
                      }
                      elseif($x>0)
                      {
                        $tval="My Contributions";
                        
                      }
                      else
                      {
                        $tval="Profit In The Bank";
                      }
                      
                      
                      ?>
                        <h3 class="mb-1 text-white text-center">{{ currency( str_replace("-","",$x),true,2,false) }}</h3>
                        <div class="text-muted text-center text-white" >
                             <?php echo $tval;?>
                        </div>
                    </div>
                </div>
                                 <div class="card bg-green" style="border-color: white;border-radius: 12px">
                    <div class="card-body" style="font-size: larger;padding: 0.75rem;">
                        <h3 class="mb-1 text-white text-center">{{ currency( $client->transactions()->deposits(),true,2,false) }}</h3>
                        <div class="text-muted text-center text-white" >
                        Deposits
                        </div>
                    </div>
                </div>
                           <div class="card" style="background-color: #3995f4;border-color: white;border-radius: 12px">
                    <div class="card-body" style="font-size: larger;padding: 0.75rem;">
                        <h3 class="mb-1 text-white text-center">{{ currency( $client->transactions()->withdrawals(),true,2,false) }}</h3>
                        <div class="text-muted text-center text-white">
                        Withdrawals
                        </div>
                    </div>
                </div>
                </div>
                        <div class="col-md-9 col-sm-12">
            
                    <div class="card-body"  style="
    margin-top: -26px;
">
                                      <!-- chandan code start-->
          <h4 class="text-center text-uppercase" style="
    font-size: 1.2em;
    color: black;
">Showing Daily Profit Growth</h4>
             <div class="card">

{{--    <div class="m-3">--}}
{{--        <div class="btn-group float-right">--}}
{{--            <a href="?type=daily&action=history" class="btn btn-secondary {{ request('type','daily') =='daily'? 'active' :'' }}">Daily</a>--}}
{{--            <a href="?type=weekly&action=history" class="btn btn-secondary  {{ request('type','daily') =='weekly'? 'active' :'' }}">Weekly</a>--}}
{{--            <a href="?type=monthly&action=history" class="btn btn-secondary  {{ request('type','daily') =='monthly'? 'active' :'' }}">Monthly</a>--}}
{{--        </div>--}}
{{--    </div>--}}
   <div class="my-4" style="
    margin-top: 10px !important;
    margin-bottom: -25px !important;
">
        @include('client.line_chart',['account' => $client])
    </div>
</div>
                      <!-- chandan code end -->
                    </div>
              
            </div>
    
     
            <br>
      
            <div class="clearfix"></div>

    
            <div class="col-md-12 col-sm-12">
      

            <div class="col-12" style="
    margin-top: -13px;
"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <div style="margin: 40px 0 40px 0;height: 4px" class="bg-success w-100">
                </div>
              <?php //die(print_r($client->transactions()->deposits()));?>
              
                        <!-- chandan code start -->
                @php $transactions = $client->transactions()->with('account')->orderByDesc('date')->paginate(28);
           
                $realprofit8=0;
              $i=0;
              @endphp
            
                               @foreach($transactions as $transaction)
            

              
                                         @php $profit = $client->investorTransactions()->profitLastDay($transaction->date);
                 $mdate=$transaction->date;
                $fdate= date('d-m-Y', strtotime($transaction->date));
             
              $newdatefromtransdate=date('d-m-Y', strtotime("-30 day", strtotime($fdate)));
              $ldate=date('d-m-Y', strtotime(now()->subDays(30)));
              $ldate1=date('d-m-Y', strtotime(now()->subDays(31)));
              $ldate2=date('d-m-Y', strtotime(now()->subDays(29)));
              
              // die(print_r($fdate));
                                         $percent = $profit * 100/ coalesce($client->transactions()->depositAt($transaction->date),1);
                                          $realprofit8 += $percent;
                                          $i++;
                                        if(strtotime($fdate)==strtotime($ldate)) break;
               if(strtotime($fdate)==strtotime($ldate1)) break;
               if(strtotime($fdate)==strtotime($ldate2)) break;
                                         
              
                @endphp
              @endforeach
              <!-- chandan coe end -->
              
                               @php $profit4 = $client->investorTransactions()->profitLastMonth();$percent4 = $profit4 * 100/ coalesce($client->transactions()->deposits(),1) ; @endphp
                @php 
                    $profit = $client->profitAt(now()) - $client->profitAt(now()->subDays(30)); 
                    $percent = 0; 
                    for($i = 0; $i < 30; $i++)
                    {
                        $tprofit = $client->profitOne(now()->subDays($i), true); 
                        $tbalance = $client->balanceDWP(now()->subDays($i));

                        if($tbalance != 0)
                            $percent += $tprofit * 100/ coalesce($tbalance,1) ; 
                    }
                @endphp                         
                <h4 class="text-center"><span class="text-uppercase">Earnings generated by my participation during the last 30 days.<br></span>
                    <b class="text-danger" style="font-size: larger">( USD {{ currency($profit) }}
                        , {{ currency($percent,true,2) }}% )</b></h4>
                <canvas id="barChart" height="471" style="display: block; width: 1132px; height: 471px;" width="1132" class="chartjs-render-monitor"></canvas>
              <br> <br> <div style="
    margin-top: -42px;
">
                <center>
           <b>  Before investing any of your personal capital you should seek the advice of a licensed financial adviser.
                <br>
                  You should never invest capital you cannot afford to lose.
                  </b></center>  
              </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="deposit" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Client Deposit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="spinner d-none ">
                        <div class="m-9 d-flex justify-content-center ">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="row equal data-row wallet d-none">
                        <div class="col-9">
                            <p>
                                Please send the exact amount as shown below, and add your transaction fee to the amount
                                you
                                send. We need to receive the exact amount shown below. A different amount will cause
                                your contribution to be retained until payed in full.
                            </p>
                            <p>
                                This payment address and the amount are valid for 10 minutes. Once this time has
                                passed, if you have not made the payment, the deposit will be canceled.
                            </p>
                            <p>
                                <span class="qr-text">Amount to send</span>
                                <code class="btc-amount" style="font-size: larger">
                                </code> BTC
                            </p>
                            <p>
                                <span class="qr-text">Sending address: </span><span
                                    class="qr-data btc-wallet"></span></span>
                            </p>
                        </div>
                        <div class="col-3 card">
                            <img
                                style="width: 100%;">
                            <span class="img-caption">You can use this QR code to obtain the wallet address.</span>
                        </div>
                    </div>
                    <div class="amount" style="font-weight: bolder">
                        <p>
                            Please understand that all deposits are locked in for a 14 day period before being available for withdrawal. 
                        </p>
                        Deposits will become active on Sundays. 
                        </p>
                        Minimum deposit 1000 USD, Maximum deposit 100,000 USD <br>
                        There is no limit on account size, or number of deposits.
                        </p>
                        
                 <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="example-checkbox2"
                                   value="option2">
                            <span
                                class="custom-control-label">&nbsp;&nbsp;I agree to send the amount in one payment</span>
                        </label>
                      <br>
                      <!--f2-->
                         <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="example-checkbox3"
                                   value="option3">
                            <span
                                class="custom-control-label">&nbsp;&nbsp;I Agree to send payment within 5 minutes</span>
                        </label>
                      <!-- f2 end-->
                      <br>
                          <!--f3-->
                         <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="example-checkbox4"
                                   value="option4">
                            <span
                                class="custom-control-label">&nbsp;&nbsp;I agree to a 1% fee</span>
                        </label>
                      <!-- f3 end-->
                      
                             <!--f4-->
                         <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="example-checkbox5"
                                   value="option5">
                            <span
                                class="custom-control-label">&nbsp;&nbsp;I understand that after 30 minutes the rate can change</span>
                        </label>
                      <!-- f4 end-->
                      
                        <p>
                            On the next page you will see your bitcoin invoice. Please make sure you have enough in your bitcoin wallet ready
                            to pay this invoice.
                        </p>
                        
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="example-checkbox1"
                                   value="option1">
                            <span
                                class="custom-control-label">&nbsp;&nbsp;By sending this deposit I am accepting these terms.</span>
                        </label>
                        <div class="invalid-feedback bog d-none">Agree to terms first!</div>
                        <div class="form-group">
                            <label class="col-form-label">Amount USD:</label>
                            <input type="number" name="amount" step="0.00000001" id="ramount" class="form-control">
                        </div>
                        <p>
                         <p>   
                         <p>
                            If you need help with the bitcoin transfer please contact: <a
                                href="mailto:support@real-profits.com">support@25-percent.com</a> for
                            assistance.
                        </p>
                    </div>
                    <div class="bg-danger error d-none text-white text-xl-center"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btm btn btn-secondary submit">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- maintaince code start -->
	    <div class="modal fade" id="deposit1" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Upgrade in process, Deposits temporally disabled</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="spinner d-none ">
                        <div class="m-9 d-flex justify-content-center ">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="row equal data-row wallet d-none">
                        <div class="col-9">
                            <p>
                             Upgrade in process, Deposits temporally disabled 
                            </p>
                      
                        </div>
             
                    </div>
            
                 
                </div>
              
            </div>
        </div>
    </div>
	
	<!-- ,maintaince code ends -->
    <div class="modal fade" id="withdraw" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Client Withdrawal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="spinner d-none">
                        <div class="m-9 d-flex justify-content-center ">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="amount" style="font-weight: bolder">
                        <p> Please complete the form below. </p>
                        <p> Capital withdrawals can be requested at any time. </p>
                        <p> Withdrawal request will be paid 14 days after the request was made.  </p>
                        <p> There is no fee charged for withdrawals. </p>
                        <form class="with">
                            @csrf
                            <div class="form-group">
                                <label class="col-form-label">Amount USD:</label>
                                <input type="number" name="amount" step="0.00000001" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Withdraw To:</label>
                                <select name="withdraw_type" class="form-control">
                                    <option>Bitcoin Wallet</option>
                                    <option>Bank Account ( Local Thailand )</option>
                                    <option>Bank Account ( International )</option>
                                    <option>Skrill</option>
                                    <option>Paypal</option>
                                </select>
                            </div>
                            <div class="form-group wallet">
                                <label class="col-form-label">Wallet Address:</label>
                                <input type="text" name="wallet" class="form-control">
                            </div>
                            <div class="form-group email d-none">
                                <label class="col-form-label">Email Address:</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                             <div class="bankinternational d-none">
                                <div class="form-group">
                                    <label class="col-form-label">Bank Name:</label>
                                    <input type="text" name="bank_name" class="form-control">
                                </div>
                                <div class="row">
                                    <!--<div class="form-group col-6">
                                        <label class="col-form-label">SWIFT CODE:</label>
                                        <input type="text" name="swift_code" class="form-control">
                                    </div>-->
                                    <div class="form-group col-6">
                                        <label class="col-form-label">Account Number:</label>
                                        <input type="text" name="bank_account" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Name of Account Holder:</label>
                                    <input type="text" name="client_name" class="form-control">
                                </div>
                                                          <div class="form-group">
                                                            <label class="col-form-label">Bank Address:</label>
                                                 <input type="text" name="bank_address" class="form-control">
                                                          </div>
														  <div class="form-group">
                                        <label class="col-form-label">Swift Code:</label>
                                        <input type="text" name="swift_code" class="form-control">
                                    </div>
									
                                                    <div class="form-group">

                                                <label class="col-form-label">Account Holder Residential Address:</label>
                              <input type="text" name="client_address" class="form-control">
                                                           </div>
                            </div>
                            
                            <div class="bank d-none">
                                <div class="form-group">
                                    <label class="col-form-label">Bank Name:</label>
                                    <input type="text" name="bank_name" class="form-control">
                                </div>
                                <div class="row">
                                    
                                    <div class="form-group col-6">
                                        <label class="col-form-label">Account Number:</label>
                                        <input type="text" name="bank_account" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Name of Account Holder:</label>
                                    <input type="text" name="client_name" class="form-control">
                                </div>
                                {{--                            <div class="form-group">--}}
                                {{--                                <label class="col-form-label">Bank Address:</label>--}}
                                {{--                                <input type="text" name="bank_address" class="form-control">--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}

                                {{--                                <label class="col-form-label">Account Holder Residential Address:</label>--}}
                                {{--                                <input type="text" name="client_address" class="form-control">--}}
                                {{--                            </div>--}}
                            </div>
                            <p>
                                If you have any questions please send an email to: <a
                                    href="mailto:support@real-profits.com">support@25-percent.com</a> for
                                assistance.
                            </p>
                        </form>
                    </div>
                    <p class="d-none success">
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btm btn btn-secondary submit">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        function setupInvestor() {
            $('#edit-investor').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var client = button.data('name');
                var clientId = button.data('id');
                var email = button.data('email');
                var commission = button.data('commission');
                var modal = $(this);
                modal.find('.modal-title').text('Edit Investor (' + client + ')');
                modal.find('.modal-body input[name=email].form-control').val(email);
                modal.find('.modal-body input[name=name].form-control').val(client);
                modal.find('.modal-content input[name=investor_id]').val(clientId);
                modal.find('.modal-body input[name=commission].form-control').val(commission);
            });
            $('.assign').on('click', function () {
                var transaction = $(this);
                axios.post(transaction.data('url')).then(function (a, b) {
                    if (a.status === 200) {
                        transaction.closest('tr').remove();
                    }
                });
            });
        }

        function setupDeposit() {
          
            $('#deposit').on('show.bs.modal', function (event) {
                var modal = $(this);
                modal.find('.spinner').toggleClass('d-none', true);
                modal.find('.error').toggleClass('d-none', true);
                modal.find('.amount').toggleClass('d-none', false);
                modal.find('.btm').toggleClass('d-none', false);
                modal.find('.wallet').toggleClass('d-none', true);
                modal.find('.bog').toggleClass('d-none', true);
                modal.find('.modal-body input[name=amount].form-control').val('');
                modal.find('.modal-body input[type=checkbox]').prop("checked", false);
                modal.find('.submit').on('click', function () {
                  var final = '';
   $('.custom-control-input:checked').each(function(){        
        var values = $(this).val();
        final += values;
    });
                  var ramount = $("#ramount").val();
                    if (final === 'option2option3option4option5option1' && (ramount>0.9)) {
                        modal.find('.spinner').toggleClass('d-none');
                        modal.find('.amount').toggleClass('d-none');
                        modal.find('.btm').toggleClass('d-none');
                        axios.get('{{ route('mind.deposit',compact('client')) }}?amount=' + modal.find('.modal-body input[name=amount].form-control').val())
                            .then(function (response) {
                                if (response.status === 200 || response.status === 201) {
                                    modal.find('img').attr('src', response.data.qrcode);
                                    modal.find('.btc-amount').html(response.data.btc);
                                    modal.find('.btc-wallet').html(response.data.address);
                                    modal.find('.spinner').toggleClass('d-none');
                                    modal.find('.wallet').toggleClass('d-none');
                                } else {
                                    modal.find('.amount').toggleClass('d-none');
                                    modal.find('.spinner').toggleClass('d-none');
                                    modal.find('.error').toggleClass('d-none');
                                    modal.find('.error').html(response.statusText);
                                }
                            }).catch(function (error) {
                            var response = error.request;
                            modal.find('.spinner').toggleClass('d-none');
                            modal.find('.error').toggleClass('d-none');
                            modal.find('.error').html(JSON.parse(response.response).message);
                        });
                    } else {
                        modal.find('.bog').toggleClass('d-none', false);
                    }
                });
            });
            $('.assign').on('click', function () {
                var transaction = $(this);
                axios.post(transaction.data('url')).then(function (a, b) {
                    if (a.status === 200) {
                        transaction.closest('tr').remove();
                    }
                });
            });
        }

        function setupWithdraw() {
            $('#withdraw').on('show.bs.modal', function (event) {
                var modal = $(this);
            modal.find('select').on('change', function () {
                    if ($(this).val() === 'Bank Account ( Local Thailand )') {
                        modal.find('.bank').toggleClass('d-none', false);
						modal.find('.bankinternational').toggleClass('d-none', true);
                        modal.find('.wallet').toggleClass('d-none', true);
                        modal.find('.email').toggleClass('d-none', true);
                    }
                    else if ($(this).val() === 'Bank Account ( International )') {
						modal.find('.bankinternational').toggleClass('d-none', false);
                     modal.find('.bank').toggleClass('d-none', true);
                        modal.find('.wallet').toggleClass('d-none', true);
                        modal.find('.email').toggleClass('d-none', true);
                    } 

                     else if ($(this).val() === 'Bitcoin Wallet') {
                        modal.find('.bank').toggleClass('d-none', true);
                        modal.find('.wallet').toggleClass('d-none', false);
                        modal.find('.email').toggleClass('d-none', true);
						modal.find('.bankinternational').toggleClass('d-none', true);
                    } else {
						modal.find('.bankinternational').toggleClass('d-none', true);
                        modal.find('.email').toggleClass('d-none', false);
                        modal.find('.bank').toggleClass('d-none', true);
                        modal.find('.wallet').toggleClass('d-none', true);
                    }
                });
                modal.find('.submit').on('click', function () {
                    modal.find('.spinner').toggleClass('d-none', false);
                    modal.find('.amount').toggleClass('d-none', true);
                    axios.post('{{ route('mind.withdraw',compact('client')) }}', modal.find('form').serialize())
                        .then(function (response) {
                            if (response.status === 200 || response.status === 201) {
                                modal.find('.success').toggleClass('d-none');
                                modal.find('.success').html(response.data.message);
                            }
                        }).catch(function (error) {
                        var response = error.request;
                        modal.find('.success').toggleClass('d-none');
                        modal.find('.success').html(JSON.parse(response.response).message);
                    });
                    modal.find('.spinner').toggleClass('d-none', true);
                    modal.find('.btm').toggleClass('d-none', true);
                });
            });
        }

        setupInvestor();
        setupDeposit();
        setupWithdraw();
    </script>
    <script>
        Chart.pluginService.register({
            beforeDraw: function (chart) {
                if (chart.config.options.elements.center) {
                    //Get ctx from string
                    var ctx = chart.chart.ctx;

                    //Get options from the center object in options
                    var centerConfig = chart.config.options.elements.center;
                    var fontStyle = centerConfig.fontStyle || 'Arial';
                    var txt = centerConfig.text;
                    var color = centerConfig.color || '#000';
                    var sidePadding = centerConfig.sidePadding || 20;
                    var sidePaddingCalculated = (sidePadding / 100) * (chart.innerRadius * 2);
                    //Start with a base font of 30px
                    ctx.font = "30px " + fontStyle;

                    //Get the width of the string and also the width of the element minus 10 to give it 5px side padding
                    var stringWidth = ctx.measureText(txt).width;
                    var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;

                    // Find out how much the font can grow in width.
                    var widthRatio = elementWidth / stringWidth;
                    var newFontSize = Math.floor(30 * widthRatio);
                    var elementHeight = (chart.innerRadius * 2);

                    // Pick a new font size so it will not be larger than the height of label.
                    var fontSizeToUse = Math.min(newFontSize, elementHeight);

                    //Set font settings to draw it correctly.
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
                    var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
                    ctx.font = fontSizeToUse + "px " + fontStyle;
                    ctx.fillStyle = color;

                    //Draw text in center
                    ctx.fillText(txt, centerX, centerY);
                }
            }
        });
    </script>
    <script>
        var labels = [@foreach(range(0,30) as $x) '{{  now()->subDays(30)->addDays($x)->format('d-m-Y') }}' @if(!$loop->last) ,@endif @endforeach];
        var colors1 = [@foreach(range(0,30) as $x)'#6c757d'@if(!$loop->last) ,@endif @endforeach];
        var colors2 = [@foreach(range(0,30) as $x)'#cccccc'@if(!$loop->last) ,@endif @endforeach];
        var colors3 = [@foreach(range(0,30) as $x)'#cccccc'@if(!$loop->last) ,@endif @endforeach];
        var data1 = [@foreach(range(0,30) as $x)  {{  $client->investorTransactions()->profitProfitDayAt(now()->subDays(30)->addDays($x)->endOfDay()) }} @if(!$loop->last) ,@endif @endforeach];
        var data2 = [@foreach(range(0,30) as $x)  {{ $client->investorTransactions()->profitReferralDayAt(now()->subDays(30)->addDays($x)->endOfDay()) }} @if(!$loop->last) ,@endif @endforeach];
        var data3 = [@foreach(range(0,30) as $x)  {{ round(($client->profitOne(now()->subDays(30)->addDays($x)->endOfDay())*100/coalesce($client->balanceDWP(now()->subDays(30)->addDays($x)->endOfDay()),1)),2) }} @if(!$loop->last) ,@endif @endforeach];
        var data = {
            labels: labels,
            datasets: [
                {
                    label: 'Profitability of my contributions',
                    data: data1,
                    backgroundColor: colors1,
                    borderWidth: 1
                }
                , {
                    label: 'Benefits of my referrals',
                    data: data2,
                    backgroundColor: colors2,
                    borderWidth: 1,
                }
            ]
        };
        var barCtx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(barCtx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [
                                    {
                                        label: 'Profitability Of My Contributions', 
                                        data: data1,
                                        backgroundColor: colors1,
                                        borderColor: '#2196f3',
                                        borderWidth: 0
                                    },
                                                                        {
                                        label: 'Benefits Of My Referrals', 
                                        data: data2,
                                        backgroundColor: colors2,
                                        borderColor: '#ff0844',
                                        borderWidth: 0
                                    },
									                          {
                                        label: 'Percentage Gain',
										opacity: 0,
										fill: false,
                                        data: data3,
                                        backgroundColor: 'rgba(255, 10, 13, 0)',
                                        borderColor: 'rgba(255, 10, 13, 0)',
                                        borderWidth: 0
                                    }
                                    
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: true,
                                layout: {
                                    padding: {
                                        left: 0,
                                        right: 0,
                                        top: 20,
                                        bottom: 0
                                    }
                                },
                                scales: {
                                    yAxes: [{
                                        stacked: true,
                                        ticks: {
//                                            max: 300,
                                            display: true,
                                            beginAtZero: true,
                                            fontColor: "#212529"
                                        },
                                        gridLines: {
                                            display: false
                                        }
                                    }],
                                    xAxes: [{
                                        stacked: true,
                                        ticks: {
                                            display:false,
                                            beginAtZero: true,
                                            fontColor: "#212529"
                                        },
                                        gridLines: {
                                            color: "#e9ebf1",
                                            display: true
                                        },
                                        barPercentage: 0.9
                                    }]
                                },
                                legend: { display: false },
                                elements: { point: { radius: 0 } },
                                tooltips: {
                                    mode: 'index',
                                    intersect: true,
                                    callbacks: {
                                       label: function(tooltipItem, data) {
											console.log(tooltipItem.datasetIndex);
											if(tooltipItem.datasetIndex==2)
											{
												var rr = ( data.datasets[tooltipItem.datasetIndex].label || '' ) + ' :  '+ data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] + ' %';
											}
											else
											{
												var rr = ( data.datasets[tooltipItem.datasetIndex].label || '' ) + ' : $ '+ data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
											}
											
											
                                            return rr;
                                        }
                                    }
                                }
                            }
                        });
      
        var pieCtx2 = document.getElementById('pieChart2').getContext('2d');
        var options = jQuery.extend(true, {}, Chart.defaults.doughnut);

        @php $math = ($client->investorTransactions()->deposits() - $client->investorTransactions()->withdrawals() ) @endphp
            options.elements = {
            center: {
                text: "{{ currency( $math==0 ? 0 : ($client->investorTransactions()->profit() * 100 / $math) ,true,2) }}%",
                color: '#495057',
                sidePadding: 30
            }
        };

        var pieChart2 = new Chart(pieCtx2, {
            type: 'pie',
            data: {
                
                datasets: [{
                    data: [{{ $client->investorTransactions()->profit() }}, {{ $client->investorTransactions()->deposits() - $client->investorTransactions()->withdrawals() }}],
                    backgroundColor: [
                       
                        '#f80844',
                         '#fd9644',
                        
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 0)',
                        'rgba(75, 192, 192, 0)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                }],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: [
                    'My Profits',
                    'My Contributions',
                ]
            },
            options: options
        });

   
        function adminperform(btnid)
		{
		//	alert(btnid);
			 $("#adminoperation").val(btnid);
		}
    </script>
    
    <style>
            button.btn.text-white {
    background: #3995f4;
}
        button.btn.text-white:hover {
    background: #0e5bab;
}
        
    </style>
@append
