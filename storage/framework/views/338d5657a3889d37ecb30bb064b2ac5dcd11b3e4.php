<?php $__env->startSection('title'); ?>
   <?php echo e($client->name); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

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
                            <img class="img-fluid" src="<?php echo e(asset('/images/arbitrage.jpg')); ?>">
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
                           href="<?php echo e(route('client', ['client' => $client, 'action' => 'dashboard'])); ?>"
                           class="nav-link <?php if(request('action') == 'dashboard'): ?> active <?php endif; ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a data-turbolinks="false"
                           href="<?php echo e(route('client', ['client' => $client, 'action' => 'referrals'])); ?>"
                           class="nav-link <?php if(request('action') == 'referrals'): ?> active <?php endif; ?>">Referrals</a>
                    </li>
                    <li class="nav-item">
                        <a data-turbolinks="false"
                           href="<?php echo e(route('client', ['client' => $client, 'action' => 'operations'])); ?>"
                           class="nav-link <?php if(request('action') == 'operations'): ?> active <?php endif; ?>">Operations</a>
                    </li>
                    <li class="nav-item">
                        <a data-turbolinks="false"
                           href="<?php echo e(route('client', ['client' => $client, 'action' => 'transactions'])); ?>"
                           class="nav-link <?php if(request('action') == 'transactions'): ?> active <?php endif; ?>">Transactions</a>
                    </li>
                    <li class="nav-item">
                        <a data-turbolinks="false"
                           href="<?php echo e(route('client', ['client' => $client, 'action' => 'history'])); ?>"
                           class="nav-link <?php if(request('action') == 'history'): ?> active <?php endif; ?>">Account
                            History</a></li>
                    <li class="nav-item">
                        <a data-turbolinks="false"
                           href="<?php echo e(route('client', ['client' => $client, 'action' => 'beneficiary'])); ?>"
                           class="nav-link <?php if(request('action') == 'beneficiary'): ?> active <?php endif; ?>">Beneficiary</a>
                    </li>
                    <li class="nav-item">
                        <a data-turbolinks="false"
                           href="<?php echo e(route('client', ['client' => $client, 'action' => 'calculator'])); ?>"
                           class="nav-link <?php if(request('action') == 'calculator'): ?> active <?php endif; ?>">Profit
                            Calculator</a>
                    </li>
                    <li class="nav-item">
                        <a href="#"
                           data-toggle="modal" data-target="#trade"
                           class="nav-link">Trade Example</a>
                    </li>
                   <?php if(user()->acting_role === 'admin'): ?>
                        <?php
                            $recipients = base64_encode(json_encode([$client->email]));
                            session()->put('url.intended', URL::full());
                        ?>
                        <li class="nav-item">
                            <a data-turbolinks="false"
                               href="<?php echo e(route('mailbox', compact('recipients'))); ?>"
                               class="nav-link">Send
                                Email</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <?php if(request('action') == 'dashboard'): ?>
                            <?php echo $__env->make('client.account', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                        <?php if(request('action') == 'calculator'): ?>
                            <?php echo $__env->make('client.calculator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                        <?php if(request('action') == 'history'): ?>
                            <?php echo $__env->make('client.history', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                        <?php if(request('action') == 'referrals'): ?>
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
                                        <?php if(user()->role=='admin'): ?>
                                            <a href="<?php echo e(route('referral',compact('client'))); ?>"
                                               class="btn btn-primary" style="
    background-color: white;
    color: black;
">Add</a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php if($client->referrals()->count()>0): ?>
                                    <table class="table card-table table-striped border-0">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $client->referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <?php echo e($referral->client->name); ?>

                                                </td>
                                                <td><?php echo e($referral->client->email); ?></td>
                                                <td>
                                                    <?php if(user()->role =='admin'): ?>
                                                        <a class="btn btn-danger btn-sm"
                                                           href="<?php echo e(route('referral',['client' => $client,'action' => 'delete','referral' => $referral])); ?>">Remove</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
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
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if(request('action') == 'transactions'): ?>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Recent Transactions</h3>
                                </div>
                                <?php $transactions = $client->transactions()->with('account')->orderByDesc('date')->paginate(); ?>
                                <?php if($transactions->count()>0): ?>
                                    <h5 id="transactions" class="p- m-0 bg-primary"></h5>
                                    <table class="table table-striped card-table m-0">
                                        <thead>
                                        <tr>
                                            
                                            <th><b>Narration</b></th>
                                            <th><b>Amount</b></th>
                                             <th><b>%</b></th>
                                            <th><b>Date (GMT)</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <?php $profit = $client->investorTransactions()->profitLastDay($transaction->date);
                                         $percent = $profit * 100/ coalesce($client->transactions()->deposits(),1) ;
                                         
                ?>
                                            <tr>
                                                
                                                <td class="wrap"
                                                    title="<?php echo e(strtoupper( $transaction->narration)); ?>"><?php echo e(strtoupper( $transaction->narration)); ?></td>
                                                <td><?php echo e(currency($transaction->amount,true,2)); ?></td>
                                                 <td><?php echo e(round($percent,2)); ?></td>
                                                <td><?php echo e(date('D d-M-yy', strtotime($transaction->date))); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <div
                                        class="p-5"><?php echo e($transactions->fragment('transactions')->appends(['action' => 'transactions'])->render()); ?></div>
                                <?php else: ?>
                                    <div class="jumbotron text-center">
                                        No transactions
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if(request('action') == 'operations'): ?>
                            <div class="card">
                                <?php if((user()->acting_role =='admin')): ?>
                                    <?php $transactions = $client->deposits()->where('status','pending')->orderByDesc('created_at')->paginate(); ?>
                                    <?php if($transactions->count()>0): ?>
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
                                            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="wrap"
                                                        title="<?php echo e(strtoupper( $transaction->address)); ?>"><?php echo e(strtoupper( $transaction->address)); ?></td>
                                                    <td><?php echo e(currency($transaction->usd,true,2)); ?></td>
                                                    <td><?php echo e(currency($transaction->btc,true,8)); ?></td>
                                                    <td><?php echo e($transaction->status); ?></td>
                                                    <td><?php echo e($transaction->created_at); ?></td>
                                                    <td>
                                                        <div class="dropdowns">
                                                            <a href="javascript:void(0)" data-toggle="dropdown" class="" aria-expanded="false"><?php echo paste_icon('more-vertical'); ?></a>
                                                            <div class="dropdown-menu dropdown-menu-right"
                                                                 x-placement="bottom-end">
                                                                <a href="<?php echo e(route('client',['action' => 'operations','role' => 'approval','client' => $client,'operation' => $transaction])); ?>"
                                                                   class="dropdown-item"><i
                                                                        class="dropdown-icon fe fe-check-circle">
                                                                    </i> Approve </a>
                                                                <a href="<?php echo e(route('client',['action' => 'operations','role' => 'rejection','client' => $client,'operation' => $transaction])); ?>"
                                                                   class="dropdown-item"><i
                                                                        class="dropdown-icon fe fe-trash">
                                                                    </i> Reject </a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                        <hr>
                                    <?php else: ?>

                                    <?php endif; ?>
                                    <?php $transactions = $client->withdrawalrequests()->where('status','pending')->orderByDesc('created_at')->paginate(); ?>

                                    <?php if($transactions->count()>0): ?>
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
                                            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo $transaction->withdrawNarration; ?></td>
                                                    <td><?php echo e(currency($transaction->amount,true,2)); ?></td>
                                                    <td><?php echo e($transaction->status); ?></td>
                                                    <td><?php echo e($transaction->created_at); ?></td>
                                                    <td>
                                                        <div class="dropdowns">
                                                            <a href="javascript:void(0)" data-toggle="dropdown" class="" aria-expanded="false"><?php echo paste_icon('more-vertical'); ?></a>
                                                            <div class="dropdown-menu dropdown-menu-right"
                                                                 x-placement="bottom-end">
                                                                <a href="<?php echo e(route('client',['action' => 'operations','w' =>true,'role' => 'approval','client' => $client,'operation' => $transaction])); ?>"
                                                                   class="dropdown-item"><i
                                                                        class="dropdown-icon fe fe-check-circle">
                                                                    </i> Approve </a>
                                                                <a href="<?php echo e(route('client',['action' => 'operations','w' =>true, 'role' => 'rejection','client' => $client,'operation' => $transaction])); ?>"
                                                                   class="dropdown-item"><i
                                                                        class="dropdown-icon fe fe-trash">
                                                                    </i> Reject </a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <div class="card-header border-0">
                                    <h3 class="card-title bg-azure-light"> Operations
                                      <small class="">
                                            <br>
                                            This page is temporally unavailable, we are working on a more reliable solution.
                                        </small>
                                     <!--<small class="">
                                            <br>   At this time there are no operations being performed
The foreign exchange market is closed on weekends </small>-->
                                    </h3>
                                </div>
                                <?php //dd(cache('stream'));?>
                             			
<div id="refresh456">
                             <?php $provider = app('App\Http\Controllers\ClientController'); ?>
                                 
                           
                              <?php echo $provider::deposits(); ?>

							  </div>
                            </div>
                        <?php endif; ?>
                        <?php if(request('action') == 'beneficiary'): ?>
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title"> Beneficiary Details </h3>
                                </div>
                                <div class="card-body col-6">
                                    <form method="post">
                                        <?php echo csrf_field(); ?>
                                        <p>I here by nominate the following individual to be my rightful BENEFICIARY
                                            of
                                            my
                                            account
                                            upon my death.</p>
                                        <div class="form-group">
                                            <label class="col-form-label">Name:</label>
                                            <input type="text" name="name" value="<?php echo e($client->payload->name); ?>"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Relationship:</label>
                                            <input type="text" name="relationship"
                                                   value="<?php echo e($client->payload->relationship); ?>"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Email:</label>
                                            <input type="text" name="email" value="<?php echo e($client->payload->email); ?>"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Phone Number:</label>
                                            <input type="text" name="phone" value="<?php echo e($client->payload->phone); ?>"
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
                        <?php endif; ?>
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
                            $5,000
                        </p>
                        <p>
                            2) Referral Link: Your referral link will be allocated to you when your account balance is
                            at $5,000
                        </p>
                        <p>
                            3) Commission Structure: A 5% commission is paid to you from every profit your referee
                            makes.
                        </p>
                        <p>
                            4) In order to qualify for commission the new member must fund their account with a minimum
                            of
                            $1000
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php if(user()->role == 'admin'): ?>
            <div class="modal fade" id="transaction" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form method="POST" action="<?php echo e(route('transaction',compact('client'))); ?>">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitle">Transaction</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <input type="hidden" name="operation" id="adminoperation" value="deposit">
                            <div class="modal-body">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label class="col-form-label">Amount:</label>
                                    <input type="number" name="amount" step="0.00000001" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Account:</label>
                                    <select class="form-select" name="account_id">
                                        <?php $__currentLoopData = \App\Account::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($account->id); ?>"><?php echo e($account->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <?php echo e(date_picker('Date','date', now()->toDateTimeString())); ?>

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
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
 <script src="https://code.jquery.com/jquery-latest.js">

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
<?php $__env->appendSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/arbitrage-trading.io/resources/views/client/profile.blade.php ENDPATH**/ ?>