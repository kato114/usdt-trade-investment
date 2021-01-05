<?php $__env->startSection('title'); ?>
    <?php echo e($report->title); ?>

    <a href="<?php echo e(route('report')); ?>"
       class="btn btn-info float-right">Back</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card">
        <table class="table card-table table-striped table-bordered datatable">
            <thead>
            <tr>
                <th>#</th>
                <th>Client</th>
                <th>Accounts</th>
                <th>Balance</th>
            </tr>
            </thead>
            <?php
                $balance= \App\InvestorTransaction::query()->deposits() -\App\InvestorTransaction::query()->withdrawals()
            ?>

            <?php $__currentLoopData = $query->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><?php echo e($x+1); ?></td>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->clients()->count()); ?></td>
                    <td><?php echo e(currency( \App\InvestorTransaction::query()->whereIn('investor_id',$user->clients()->pluck('id'))->deposits() -\App\InvestorTransaction::query()->whereIn('investor_id',$user->clients()->pluck('id'))->withdrawals())); ?></td>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tfoot>
            <tr>
                <td colspan="2"></td>
                <td><b>Totals</b></td>
                <td><?php echo e(currency($balance,true,2)); ?></td>
            </tr>
            </tfoot>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make( 'layouts.reports', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/arbitrage-trading.io/resources/views/reports/finance/deposits_by_user.blade.php ENDPATH**/ ?>