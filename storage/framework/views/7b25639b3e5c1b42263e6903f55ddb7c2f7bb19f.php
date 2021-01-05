<div class="card">
    <div class="card-status bg-teal"></div>
    <div class="card-header" style="
    background: white;
">
        <h3 class="card-title"> Current Fund value: $
            <?php echo e(currency( normalize( $client->balance),true,2)); ?>

        </h3>
        <div class="card-options">
            <span
                class="pt-1 mr-2 card-title  d-inline-block"> Account Opened: <?php echo e($client->opened_at->format('jS M Y')); ?></span>
           <?php if((user()->role == 'admin' && user()->acting_role === 'admin')): ?>
           <div class="btnWraper">
                <button data-toggle="modal" data-target="#transaction" id="deposit" data-type="deposit" onclick="adminperform(this.id);" class="btn btn-success">
                    Deposit
                </button>
                <button data-toggle="modal" data-target="#transaction" id="withdraw" data-type="withdraw" onclick="adminperform(this.id);" class="btn btn-primary mx-2">Withdraw
                </button>
                   </div>
            <?php else: ?>
            <?php if(user()->acting_role != 'admin' && user()->acting_role != 'manager'): ?>
            <div class="btnWraper">
               <button data-toggle="modal" data-target="#deposit" data-type="deposit" class="btn btn-success mr-4">
                    Deposit
                </button>
               <!--  <button data-toggle="modal" data-target="#deposit1" data-type="deposit1" class="btn btn-success mr-4">
                    Deposit
                </button>-->
                <button data-toggle="modal" data-target="#withdraw" data-type="withdraw" class="btn text-white">
                    Withdraw
                </button>
                </div>
                   <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <?php $__currentLoopData = $periods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $period): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3 col-sm-12">
                    <div class="card" style="border-color: white;background-color: #f80844;border-radius: 8px">
                        <div class="card-body" style="font-size: larger">
                            <h3 class="mb-1 text-white text-center"><?php echo e(currency( normalize( $client->transactions()->where('type','profit')->whereBetween('date',[$period->start, $period->end])->profit()),true,2,false)); ?></h3>
                            <div class="text-muted text-center text-white"
                                 title="<?php echo e(date_range($period->start,$period->end)); ?>">
                              Profit
                                
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 col-sm-12">
                <div class="card bg-orange" style="border-color: white; border-radius: 8px">
                    <div class="card-body" style="font-size: larger">
                        <h3 class="mb-1 text-white text-center"><?php echo e(currency( $client->transactions()->deposits() - $client->transactions()->withdrawals(),true,2,false)); ?></h3>
                        <div class="text-muted text-center text-white" >
                             My Contributions
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="card bg-green" style="border-color: white;border-radius: 8px">
                    <div class="card-body" style="font-size: larger">
                        <h3 class="mb-1 text-white text-center"><?php echo e(currency( $client->transactions()->deposits(),true,2,false)); ?></h3>
                        <div class="text-muted text-center text-white" >
                        Deposits
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="card" style="background-color: #3995f4;border-color: white;border-radius: 8px">
                    <div class="card-body" style="font-size: larger">
                        <h3 class="mb-1 text-white text-center"><?php echo e(currency( $client->transactions()->withdrawals(),true,2,false)); ?></h3>
                        <div class="text-muted text-center text-white">
                        Withdrawals
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="clearfix"></div>

            <div class="col-md-6 col-sm-12">
                <h4 class="profitability text-center text-uppercase">Profitability of my contributions</h4>
                <canvas id="pieChart2" height="170"></canvas>
            </div>
            <div class="col-md-6 col-sm-12">
                <h4 class="text-center text-uppercase">Source of profits</h4>
                <canvas id="pieChart" height="170"></canvas>
            </div>

            <div class="col-12">
                <div style="margin: 40px 0 40px 0;height: 4px" class="bg-success w-100">
                </div>
                <?php $profit = $client->investorTransactions()->profitLastMonth();$percent = $profit * 100/ coalesce($client->transactions()->deposits(),1) ; ?>
                <h4 class="text-center"><span class="text-uppercase">Earnings generated by my participation during the last 30 days.<br></span>
                    Excluding Referrals <b class="text-danger" style="font-size: larger">( USD <?php echo e(currency($profit)); ?>

                        , <?php echo e(currency($percent,true,2)); ?>% )</b></h4>
                <canvas id="barChart" height="<?php if((new \Jenssegers\Agent\Agent())->isDesktop()): ?> 125 <?php elseif((new \Jenssegers\Agent\Agent())->isTablet()): ?> 150 <?php else: ?> 250 <?php endif; ?>"></canvas>
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
                                This payment address and the amount are valid for 120 minutes. Once this time has
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
                            Please understand that all deposits are locked in for a 90 day period before being available
                            for withdrawal.
                        </p>
                        <p>
                            Deposits will become active after three working days.
                        </p>
                        <p>
                            Minimum deposit 100 USD, Maximum deposit 100,000 USD
                        </p>
                        <p>
                            On the next page you will see your bitcoin invoice. Please make sure you have bitcoin ready
                            to pay the invoice.
                        </p>
                        <p>
                            If you need help with the bitcoin transfer please contact: <a
                                href="mailto:support@arbitrage-trading.io">support@arbitrage-trading.io</a> for
                            assistance.
                        </p>
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="example-checkbox1"
                                   value="option1">
                            <span
                                class="custom-control-label">By sending a deposit you are accepting these terms.</span>
                        </label>
                        <div class="invalid-feedback bog d-none">Agree to terms first!</div>
                        <div class="form-group">
                            <label class="col-form-label">Amount USD:</label>
                            <input type="number" name="amount" step="0.00000001" class="form-control">
                        </div>
                    </div>
                    <div class="bg-danger error d-none text-white text-xl-center">

                    </div>
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
                        <p>
                            Please enter the details in the form below.Please be advised that withdrawals will be
                            processed within 24 hours.
                        </p>
                        <form class="with">
                            <?php echo csrf_field(); ?>
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
                                
                                
                                
                                
                                

                                
                                
                                
                            </div>
                            <p>
                                If you have any questions please send an email to: <a
                                    href="mailto:support@arbitrage-trading.io">support@arbitrage-trading.io</a> for
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
<?php $__env->startSection('scripts'); ?>
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
                    if (modal.find('.modal-body input[type=checkbox]').prop("checked") === true) {
                        modal.find('.spinner').toggleClass('d-none');
                        modal.find('.amount').toggleClass('d-none');
                        modal.find('.btm').toggleClass('d-none');
                        axios.get('<?php echo e(route('mind.deposit',compact('client'))); ?>?amount=' + modal.find('.modal-body input[name=amount].form-control').val())
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
                    axios.post('<?php echo e(route('mind.withdraw',compact('client'))); ?>', modal.find('form').serialize())
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
        var labels = [<?php $__currentLoopData = range(0,30); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> '<?php echo e(now()->subDays(30)->addDays($x)->format('d-m-Y')); ?>' <?php if(!$loop->last): ?> ,<?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>];
        var colors1 = [<?php $__currentLoopData = range(0,30); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>'#6c757d'<?php if(!$loop->last): ?> ,<?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>];
        var colors2 = [<?php $__currentLoopData = range(0,30); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>'#cccccc'<?php if(!$loop->last): ?> ,<?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>];
        var colors3 = [<?php $__currentLoopData = range(0,30); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>'#cccccc'<?php if(!$loop->last): ?> ,<?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>];
        var data1 = [<?php $__currentLoopData = range(0,30); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <?php echo e($client->investorTransactions()->profitProfitDayAt(now()->subDays(30)->addDays($x)->endOfDay())); ?> <?php if(!$loop->last): ?> ,<?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>];
        var data2 = [<?php $__currentLoopData = range(0,30); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <?php echo e($client->investorTransactions()->profitReferralDayAt(now()->subDays(30)->addDays($x)->endOfDay())); ?> <?php if(!$loop->last): ?> ,<?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>];
          var data3 = [<?php $__currentLoopData = range(0,30); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <?php echo e(round(($client->investorTransactions()->profitProfitDayAt(now()->subDays(30)->addDays($x)->endOfDay())*100/coalesce($client->transactions()->deposits(),1)),2)); ?> <?php if(!$loop->last): ?> ,<?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>];
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
        var pieCtx = document.getElementById('pieChart').getContext('2d');
        var pieCtx2 = document.getElementById('pieChart2').getContext('2d');
        var options = jQuery.extend(true, {}, Chart.defaults.doughnut);

        <?php $math = ($client->investorTransactions()->deposits() - $client->investorTransactions()->withdrawals() ) ?>
            options.elements = {
            center: {
                text: "<?php echo e(currency( $math==0 ? 0 : ($client->investorTransactions()->profit() * 100 / $math) ,true,2)); ?>%",
                color: '#495057',
                sidePadding: 30
            }
        };

        var pieChart2 = new Chart(pieCtx2, {
            type: 'pie',
            data: {
                
                datasets: [{
                    data: [<?php echo e($client->investorTransactions()->profit()); ?>, <?php echo e($client->investorTransactions()->deposits() - $client->investorTransactions()->withdrawals()); ?>],
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

        var pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                
                datasets: [{
                    data: [ <?php echo e($client->investorTransactions()->profitProfit()); ?>, <?php echo e($client->investorTransactions()->profitReferral()); ?>],
                   
                    
                   
                                        backgroundColor: [
                        '#6c757d',
                        '#cccccc',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 0)',
                        'rgba(250,179,255,0)',
                        'rgba(255, 159, 64, 1)'
                    ],
                }],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: [
                    'Profitability of my contributions',
                    'Profits from my referrals'
                ]
            },
            options: Chart.defaults.doughnut
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
<?php $__env->appendSection(); ?>
<?php /**PATH /home/paulsclub/public_html/arbitrage-trading.io/resources/views/client/account.blade.php ENDPATH**/ ?>