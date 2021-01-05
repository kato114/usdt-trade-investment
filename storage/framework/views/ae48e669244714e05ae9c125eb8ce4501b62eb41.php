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
                <th>Wallet Address</th>
                <th>Requested USD</th>
                <th>Requested BTC</th>
                <th>Confirmed Amount</th>
                <th>Date (GMT)</th>
                <th>Request Status</th>
            </tr>
            </thead>
            <?php $__currentLoopData = $deposit->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $client->deposits()->where('status','pending')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($x+1); ?></td>
                        <td>
                            <a href="<?php echo e(route('client',['client' => $client,'action' =>'operations'])); ?>"> <?php echo e($client->name); ?> </a>
                        </td>
                        <td><?php echo e($deposit->account->name); ?></td>
                        <td><a href="https://www.blockchain.com/en/btc/address/<?php echo e($deposit->address); ?>"><?php echo e($deposit->address); ?></a></td>
                        <td><?php echo e(currency($deposit->usd,true,2)); ?></td>
                        <td class="text-danger"><?php echo e(currency($deposit->btc,true,8)); ?></td>
                        <td class="text-primary"><?php echo e(currency($deposit->rbtc,true,8)); ?></td>
                        <td><?php echo e($deposit->created_at); ?></td>
                        <td><?php echo e($deposit->status); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tfoot>
            </tfoot>
        </table>
    </div>

    <div class="card">
        <table class="table card-table table-striped table-bordered datatable">
            <thead>
            <tr>
                <th>#</th>
                <th>Client</th>
                <th>Wallet Address</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <?php $__currentLoopData = $withdraw->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $client->withdrawalRequests()->where('status','pending')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php //die(print_r($withdraw->withdraw_type));?>
                    <tr>
                        <td><?php echo e($x+1); ?></td>
                        <td>
                            <a href="<?php echo e(route('client',['client' => $client,'action' =>'operations'])); ?>"> <?php echo e($client->name); ?> </a>
                        </td>
                        <td><a href="https://www.blockchain.com/en/btc/address/<?php echo e($withdraw->address); ?>"><?php echo e($withdraw->wallet); ?></a></td>
                        <td><?php echo e(currency($withdraw->amount,true,2)); ?></td>
                        <td><?php echo e($withdraw->created_at); ?></td>
                        <td><?php echo e($withdraw->status); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tfoot>
            </tfoot>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make( 'layouts.reports', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\25-percent\resources\views/reports/finance/pending_transaction.blade.php ENDPATH**/ ?>