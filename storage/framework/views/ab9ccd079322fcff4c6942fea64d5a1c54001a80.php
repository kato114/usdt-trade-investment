<?php $__env->startSection('body'); ?>
    <?php
    $c_url="https://blockchain.info/tobtc?currency=USD&value=1";
    $c_obj = curl_init();

    $optArray = array(CURLOPT_URL =>$c_url,CURLOPT_RETURNTRANSFER => true);
    curl_setopt_array($c_obj, $optArray);

    $btc_rate = curl_exec($c_obj);
    curl_close($c_obj);
    
    // $network = new App\BlockExplorer\NetworkInfo(env('BTC_IP') , env('BTC_PORT') , env('BTC_USER') , env('BTC_PASS'));
    
    $wallet_balance = 10;
    $wallet_balance_usd = $wallet_balance / $btc_rate;

    $inp_count = 2;
    $trans_size = 180*$inp_count + 64 + $inp_count;

    $btc_fee['Priority'] = 10;
    $btc_fee['Std'] = 10;
    
    ?>

    <nav class="navbar navbar-expand-lg navbar-light navbar-primary" id="navbar-primary">
        <div class="container">
            <span class="navbar-brand navbar-brand-autodark d-none-navbar-vertical">
                <img src="<?php echo e(asset('images/logo.png')); ?>"
                     class="navbar-brand-logo navbar-brand-logo-large"> <?php echo e(config('app.name')); ?>

            </span>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <?php echo e(__('Logout')); ?>

                </a>

                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                      style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
            <ul class="navbar-nav ml-auto">

                <?php if(auth()->guard()->guest()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Create Account')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                    </li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="avatar avatar-sm mr-3"
                                  style="background-image: url(<?php echo e(user()->photo); ?>)"></span>
                            <?php echo e(user()->name); ?>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="<?php echo e(url('profile')); ?>">
                          <span class="nav-link-icon">
                               <?php echo paste_icon('user'); ?>
                            </span>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"
                               onclick="document.getElementById('logout-form').submit();">
                                                          <span class="nav-link-icon">
                                <?php echo paste_icon('log-out'); ?>
                                                          </span>
                                Logout
                            </a>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-primary" id="navbar-primary">
        <div class="container">
            <div class="navbar-collapse collapse">
                <h6 class="navbar-heading">Navigation</h6>
                <ul class="navbar-nav tabHeader">
                    <li class="nav-item">
                        <a class="nav-link <?php if(route_matches('/home')): ?> active <?php endif; ?>"
                           href="<?php echo e(url('/home')); ?>">
                          <span class="nav-link-icon">
                                        <?php echo paste_icon('home'); ?>
                                    </span>
                            Dashboard
                        </a>
                    </li>

                    <?php if(user()): ?>
                        <?php if(user()->role == 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle <?php if(route_matches('support')): ?> active <?php endif; ?>"
                                   role="button"
                                   href="<?php echo e(route('support')); ?>" data-toggle="dropdown">
                                    <span class="nav-link-icon">
                                        <?php echo paste_icon('settings'); ?>
                                    </span>
                                    Administration
                                </a>
                                <ul class="dropdown-menu dropdown-menu-arrow">
                                    <li>
                                        <a href="<?php echo e(route('support',['section' => 'users'])); ?>"
                                           class="dropdown-item <?php if(request('section') =='users'): ?> active <?php endif; ?>">
                                            Administrators
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('support',['section' => 'accounts'])); ?>"
                                           class="dropdown-item <?php if(request('section') =='accounts'): ?> active <?php endif; ?>">
                                            Accounts
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('support',['section' => 'clients'])); ?>"
                                           class="dropdown-item <?php if(request('section') =='clients'): ?> active <?php endif; ?>">
                                            Clients
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('support',['section' => 'requests'])); ?>"
                                           class="dropdown-item <?php if(request('section') =='requests'): ?> active <?php endif; ?>">
                                            Registration Requests
                                        </a>
                                    </li>
                                     <?php if(user()->acting_role === 'admin'): ?>
                                    <li>
                                        <a href="#"
                                           data-toggle="modal" data-target="#profit"
                                           class="dropdown-item">
                                            Profits
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           data-toggle="modal" data-target="#auto_profit"
                                           class="dropdown-item">
                                            Auto Profits
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           data-toggle="modal" data-target="#withdraw"
                                           class="dropdown-item">
                                            Withdraw
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                             <?php if(user()->acting_role === 'admin'): ?>
                            <li class="nav-item">
                                <a data-turbolinks="false"
                                   class="nav-link <?php if(route_matches('mailbox')): ?> active <?php endif; ?>"
                                   href="<?php echo e(route('mailbox')); ?>"><i class="fe fe-mail"></i>Mail Box</a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if(route_matches('reports')): ?> active <?php endif; ?>"
                                   href="<?php echo e(route('report')); ?>"><i class="fe fe-file"></i> Reports</a>
                            </li>
 <?php if(user()->acting_role === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link text-white <?php if(route_matches('support.resolution')): ?> active <?php endif; ?>"
                                   href="<?php echo e(route('support.resolution')); ?>"> <i class="fe fe-life-buoy"></i>Help
                                    Desk</a>
                            </li>
                             <?php endif; ?>

                        <?php else: ?>
                         <?php if(user()->acting_role === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link text-white <?php if(route_matches('support.ticket')): ?> active <?php endif; ?>"
                                   href="<?php echo e(route('support.ticket')); ?>"> <i class="fe fe-life-buoy"></i>Help
                                    Desk</a>
                            </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="content">
        <main class="container">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h2 class="page-title">
                            <?php echo $__env->yieldContent('title'); ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php if(session()->has('success')): ?>
                        <?php $message = isset($message) ? $message :session()->pull('success') ?>
                    <?php endif; ?>
                    <?php if(session()->has('failure')): ?>
                        <?php $error = isset($error)? $error : session()->pull('failure') ?>
                    <?php endif; ?>
                    <?php if(isset($message)): ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success alert-dismissible" data-dismiss="alert" role="alert">
                                    <?php echo e(__($message)); ?>

                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            </div>
                        </div>
                    <?php elseif(isset($error)): ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible" data-dismiss="alert" role="alert">
                                    <?php echo e(__($error)); ?>

                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </main>
    </div>
    <div class="modal fade" id="auto_profit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="<?php echo e(route('auto_profit')); ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Auto Profit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label">Profit Amount:</label>
                                    <input type="number" name="amount" step="0.00000001" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
     <div class="modal fade" id="withdraw" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Transfer Funds</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label class="col-form-label w-100">Current Balance: <?php echo e(number_format(isset($wallet_balance) ? $wallet_balance : 0 , 8)); ?> BTC
                                &nbsp;&nbsp;&nbsp;
                                <span class="float-right col-md-6">$ <?php echo e(number_format($wallet_balance_usd, 2)); ?></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Address:</label>
                                        <input type="text" name="address"  class="form-control" required placeholder="Paste destination">
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">USD:</label>
                                    <input type="number" id="amount_usd" name="amount" step="0.01" value="0" class="form-control" required placeholder="$0.00">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">BTC: &nbsp;&nbsp;&nbsp; <button type="button" class="btn btn-link btn-use-max p-0">Use Maximum</button></label>
                                    <input type="number" id="amount_btc" name="amount_btc" step="0.00000001" value="0" class="form-control" required placeholder="0">
                                </div>
                            </div><br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Description:</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div><br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Estimated Network Fee:</label>
                                        <select name="fee_hour" class="form-control">
                                        <option value="1"> 
                                            Standard&nbsp;&nbsp;&nbsp;
                                            <?php echo e(number_format($btc_fee['Std'],8)); ?> BTC 
                                            (<?php echo e(number_format($btc_fee['Std'] / $btc_rate, 2)); ?> USD) 
                                        </option>
                                        <option value="6"> 
                                            Priority&nbsp;&nbsp;&nbsp;
                                            <?php echo e(number_format($btc_fee['Priority'],8)); ?> BTC 
                                            (<?php echo e(number_format($btc_fee['Priority'] / $btc_rate, 2)); ?> USD) 
                                        </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Fee Type:</label>
                                        <select name="fee_type" class="form-control">
                                        <option value="add">Fee added to transaction</option>
                                        <option value="contain">Fee deducted from transaction</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-withdraw">Withdraw</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="profit" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="align-items: flex-end;">
            <div class="modal-content">
                <form method="POST" action="<?php echo e(route('profit')); ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Profit Transaction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label class="col-form-label">Account:</label>
                            <select class="form-select" name="account_id">
                                <?php $__currentLoopData = \App\Account::query()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($account->id); ?>"><?php echo e($account->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Ticket:</label>
                                    <input type="text" name="ticket" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Profit/Loss:</label>
                                    <input type="number" name="amount" step="0.00000001" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-8">
                                        <?php echo e(date_picker('Date','date', now()->toDateTimeString())); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright © <?php echo e(date('Y')); ?> <a href="." class="tesxt-white"><?php echo e(config('app.name')); ?></a>.
                    Theme by <a href="https://codecalm.net" class="tsext-white" target="_blank">codecalm.net</a>
                    All
                    rights reserved.
                </div>
            </div>
        </div>
    </footer>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        var btc_rate = "<?php echo e(isset($btc_rate) ? $btc_rate : 0); ?>";
        var wallet_balance = "<?php echo e($wallet_balance); ?>" * 1;
        var wallet_balance_usd = "<?php echo e($wallet_balance_usd); ?>" * 1;
        
        function setupInvestor() {
            $('.assign').on('click', function () {
                var transaction = $(this);
                axios.post(transaction.data('url')).then(function (a, b) {
                    if (a.status === 200) {
                        transaction.closest('tr').remove();
                    }
                });
            });
        }

        $(document).ready(function () {
            setupInvestor();

            btc_rate = btc_rate * 1;

            $("#amount_usd").on('keyup', function() {
                $("#amount_btc").val(($("#amount_usd").val() * btc_rate).toFixed(8));
            });

            $("#amount_btc").on('keyup', function() {
                $("#amount_usd").val(($("#amount_btc").val() / btc_rate).toFixed(2));
            });
            
            $(".btn-use-max").on('click', function() {
                $("#amount_btc").val(wallet_balance);
                $("#amount_usd").val(wallet_balance_usd.toFixed(2));
            });
        });
    </script>
<?php $__env->appendSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\25-percent\resources\views/layouts/main.blade.php ENDPATH**/ ?>