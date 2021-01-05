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
                <th>Withdraw Type</th>
                <th>Amount USD</th>
				<th>Bitcoin Wallet</th>
				<th>Bank Name</th>
				<th>Bank Address</th>
				<th>client_address</th>
				<th>swift_code</th>
				<th>bank_account</th>
				<th>email</th>
				<th>date</th>
            </tr>
            </thead>
            <?php $__currentLoopData = $query->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $client->withdrawalRequests()->where('status','pending')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php //die(print_r($withdraw->withdraw_type));?>
                    <tr>
                        <td><?php echo e($x+1); ?></td>
                        <td>
                            <a href="<?php echo e(route('client',['client' => $client,'action' =>'operations'])); ?>"> <?php echo e($client->name); ?> </a>
                        </td>
                        <td><?php echo e($withdraw->withdraw_type); ?></td>
                        <td><?php echo e(currency( $withdraw->amount)); ?></td>
						 <td><?php echo e($withdraw->wallet); ?></td>
                        <td><?php echo e($withdraw->bank_name); ?></td>
						<td><?php echo e($withdraw->bank_address); ?></td>
						<td><?php echo e($withdraw->client_address); ?></td>
						<td><?php echo e($withdraw->swift_code); ?></td>
						<td><?php echo e($withdraw->bank_account); ?></td>
						<td><?php echo e($withdraw->email); ?></td>
						<td><?php echo e($withdraw->created_at); ?></td>
                        
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tfoot>
            </tfoot>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make( 'layouts.reports', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/arbitrage-trading.io/resources/views/reports/finance/pending_withdraw.blade.php ENDPATH**/ ?>