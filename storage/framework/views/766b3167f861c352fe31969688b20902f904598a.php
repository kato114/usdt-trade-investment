<?php $__env->startSection('body'); ?>

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
                        <a class="nav-link <?php if(route_matches('/')): ?> active <?php endif; ?>"
                           href="<?php echo e(url('/')); ?>">
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
    <div class="modal fade" id="profit" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
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
                                    <option value="<?php echo e($account->account); ?>"><?php echo e($account->name); ?></option>
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
        });
    </script>
<?php $__env->appendSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/arbitrage-trading.io/resources/views/layouts/main.blade.php ENDPATH**/ ?>