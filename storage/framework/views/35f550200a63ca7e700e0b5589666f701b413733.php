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
                <th>Account</th>
                <th>Deposits</th>
                <th>Profit %</th>
                <th>Balance</th>
            </tr>
            </thead>
            <?php
                $deposits= \App\InvestorTransaction::query()->deposits() - \App\InvestorTransaction::query()->withdrawals();
                $balance =\App\InvestorTransaction::query()->balance()
            ?>
            <?php $__currentLoopData = $query->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><?php echo e($x+1); ?></td>
                    <td><?php echo e($client->name); ?></td>
                    <td><?php echo e($client->name); ?></td>
                    <td><?php echo e(currency( $client->investorTransactions()->deposits() - $client->investorTransactions()->withdrawals())); ?></td>
                    <td><?php echo e(currency( $client->commission)); ?></td>
                    <td><?php echo e(currency( $client->balance)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tfoot>
            <tr>
                <td colspan="2"></td>
                <td><b>Total Deposits</b></td>
                <td><?php echo e(currency($deposits,true,2)); ?></td>
                <td><b>Total Balance</b></td>
                <td><?php echo e(currency($balance,true,2)); ?></td>
            </tr>
            </tfoot>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make( 'layouts.reports', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/percen25/public_html/resources/views/reports/finance/deposits.blade.php ENDPATH**/ ?>