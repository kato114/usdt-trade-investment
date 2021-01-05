<?php $__env->startSection('title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="mx-0">
        <table class="table">
            <tr>
                <td colspan="1" class="border-0 pl-0">
                    <div class="card mx-0">
                        <div class="card-body p-3 text-center">
                            <div class="text-right text-green">
                                &nbsp;
                            </div>
                            <div class="h1 m-0"><?php echo e(now()->toTimeString()); ?></div>
                            <div class="text-muted mb-4">Server Time (GMT)</div>
                        </div>
                    </div>
                </td>
                <td colspan="1" class="border-0">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="text-right text-green">
                                &nbsp;
                            </div>
                            <div class="h1 m-0"><?php echo e(currency($clients->count(),true,0,true)); ?></div>
                            <div class="text-muted mb-4">Clients</div>
                        </div>
                    </div>
                </td>
                <td colspan="2" class="border-0">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="text-right">
                                &nbsp;&nbsp;USD
                            </div>
                            <div class="h1 m-0"><?php echo e(currency($totalFund,true,2)); ?></div>
                            <div class="text-muted mb-4">Total Club Fund</div>
                        </div>
                    </div>
                </td>
                <?php $__currentLoopData = $periods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $period): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td colspan="2" class="border-0">
                        <div class="card">
                            <div class="card-body p-3 text-center">
                                <div class="text-right">
                                    &nbsp;&nbsp;USD
                                </div>
                                <?php
                                    $profit  =  App\Transaction::query()->whereBetween('date', [$period->start, $period->end])->profit();
                                ?>
                                <div class="h1 m-0"><?php echo e(currency($profit,true,2,!true)); ?></div>
                                <div class="text-muted mb-4"> Profit (<?php echo e($period->name); ?>)</div>
                            </div>
                        </div>
                    </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <td colspan="2" class="border-0 pr-0">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="text-right">
                                &nbsp;&nbsp;USD
                            </div>
                            <div class="h1 m-0"><?php echo e(currency($deposits,true,2,!true)); ?></div>
                            <div class="text-muted mb-4"> Total Deposits</div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <div class="card">
            <table class="table table-striped card-table">
                <thead>
                <tr>
                    <th><b>Ticket</b></th>
                    <th><b>Type</b></th>
                    <th><b>Amount</b></th>
                    <th><b>Date (GMT)</b></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = \App\Transaction::query()->orderByDesc('date')->paginate(20); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><b><?php echo e($interest->ticket); ?>                    </b></td>
                        <td><b><?php echo e($interest->type); ?></b></td>
                        <td><b><?php echo e(currency( $interest->amount,true,2)); ?></b></td>
                        <td><b><?php echo e(date('D d-M-yy', strtotime($interest->date))); ?></b></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\25-percent\resources\views/home.blade.php ENDPATH**/ ?>