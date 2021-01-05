<?php $__env->startSection('styles'); ?>
    <style>
        @page  {
            size: landscape !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    Reports
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if((user()->role == 'admin' && user()->acting_role === 'admin')): ?>
    <div class="card">
        <div class="card-header">
            <?php echo e(ucfirst( user()->acting_role)); ?> Reports
        </div>
        <div class="card-body">
            <div class="col-12 p-0 mt-3">
                <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php //print_r($report->slug);
                if($report->slug=='client_deposits_by_user')
                {
                    // break;
                }
                else
                {
                ?>
                    <?php if(!in_array($report->slug,['account_statement','account_ftp_statement'])): ?>
                        <a class="btn btn-outline-primary mr-1 mt-1"
                           href="<?php echo e(route('report',['report' => $report->slug])); ?>"><?php echo e($report->title); ?></a>
                    <?php endif; ?>
                    <?php
                }
                ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php else: ?>
<div class="card">
        <div class="card-header">
            Manager Reports
        </div>
        <div class="card-body">
            <div class="col-12 p-0 mt-3">
                                                            <a class="btn btn-outline-primary mr-1 mt-1" href="https://arbitrage-trading.io/public/reports/admin_listing">Admin Listing</a>
                                                                                <a class="btn btn-outline-primary mr-1 mt-1" href="https://arbitrage-trading.io/public/reports/client_listing">Client Listing</a>
                                                                                                                    <a class="btn btn-outline-primary mr-1 mt-1" href="https://arbitrage-trading.io/public/reports/client_deposits">Client Deposits</a>
                                                                                
                                                </div>
        </div>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/my-passive-income.net/resources/views/reports/index.blade.php ENDPATH**/ ?>