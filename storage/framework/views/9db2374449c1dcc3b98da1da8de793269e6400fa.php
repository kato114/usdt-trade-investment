<div class="card">
    <div class="card-header">
        <p class="card-title">
            Deposit & Withdraw
        </p>
    </div>
    <div class="my-4">
		<div>
            <?php 
            	$deposit_request = $client->deposits()->orderByDesc('created_at')->paginate(); 
            ?>
			<table class="table">
				<thead>
					<tr>
                        <th>Date (GMT)</th>
						<th>Wallet Address</th>
                        <th>Requested USD</th>
                        <th>Requested BTC</th>
                        <th>Confirmed Amount</th>
						<th>Request Status</th>
					</tr>
				</thead>
				<tbody>
		            <?php if($deposit_request->count()>0): ?>
		           		<?php $__currentLoopData = $deposit_request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		           		<tr>
                        <td><?php echo e($request->created_at); ?></td>
                        <td class="wrap" title="<?php echo e(strtoupper( $request->address)); ?>"><?php echo e(strtoupper( $request->address)); ?></td>
                        <td><?php echo e(currency($request->usd,true,2)); ?></td>
                        <td class="text-danger"><?php echo e(currency($request->btc,true,8)); ?></td>
                        <td class="text-primary"><?php echo e(currency($request->rbtc,true,8)); ?></td>
                        <td><?php echo e($request->status); ?></td>
                    	</tr>
		           		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		           	<?php else: ?>
						<tr>
							<td class="text-center" colspan="5">There is no deposit transaction.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
		<br><br>
		<div>
            <?php 
            	$deposit_request = $client->deposits()->orderByDesc('created_at')->paginate(); 
            ?>
			<table class="table">
				<thead>
					<tr>
                        <th>Date (GMT)</th>
						<th>Withdraw Address</th>
                        <th>Requested USD</th>
                        <th>Requested BTC</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
		            <?php if($deposit_request->count()>0): ?>
		           		<?php $__currentLoopData = $deposit_request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		           		<tr>
                        <td><?php echo e($request->created_at); ?></td>
                        <td class="wrap" title="<?php echo e(strtoupper( $request->address)); ?>"><?php echo e(strtoupper( $request->address)); ?></td>
                        <td><?php echo e(currency($request->usd,true,2)); ?></td>
                        <td class="text-danger"><?php echo e(currency($request->btc,true,8)); ?></td>
                        <td><?php echo e($request->status); ?></td>
                    	</tr>
		           		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		           	<?php else: ?>
						<tr>
							<td class="text-center" colspan="5">There is no withdraw transaction.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
    </div>
</div>
<?php /**PATH /home/percen25/public_html/resources/views/client/wallet.blade.php ENDPATH**/ ?>