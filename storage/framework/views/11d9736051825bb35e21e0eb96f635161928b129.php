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
                <th>Amount USD</th>
                <th>Amount BTC</th>
                <th>Wallet</th>
            </tr>
            </thead>
            <?php $__currentLoopData = $query->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $client->deposits()->where('status','pending')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($x+1); ?></td>
                        <td>
                            <a href="<?php echo e(route('client',['client' => $client,'action' =>'operations'])); ?>"> <?php echo e($client->name); ?> </a>
                        </td>
                        <td><?php echo e($deposit->account->name); ?></td>
                        <td><?php echo e(currency( $deposit->usd)); ?></td>
                        <td><?php echo e(currency( $deposit->btc,true,8)); ?></td>
                        <td>
                            <a href="https://www.blockchain.com/en/btc/address/<?php echo e($deposit->address); ?>"><?php echo e($deposit->address); ?></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tfoot>
            </tfoot>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make( 'layouts.reports', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\25-percent\resources\views/reports/finance/pending_deposits.blade.php ENDPATH**/ ?>