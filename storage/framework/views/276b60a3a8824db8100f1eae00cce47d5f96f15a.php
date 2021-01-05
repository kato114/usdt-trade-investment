<?php $__env->startSection('title'); ?>
    <?php echo e($report->title); ?>

    <a href="<?php echo e(route('report')); ?>"
       class="btn btn-info float-right">Back</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card">
        <table class="table card-table table-striped table-bordered">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Client</td>
					
                    <td>Referal Name</td>
                 
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $clients->cursor(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php //die(print_r());?>
                    <tr>
                        <td><i><?php echo e($x+1); ?></i></td>
                        <td><a
                                    href="<?php echo e(route('client',['client' => $client])); ?>"><?php echo e($client->name); ?></a>
                        </td>
						
                        <td>
						    <?php $provider = app('App\Http\Controllers\ClientController'); ?>
                             
      <?php echo $provider::rname($client->id); ?>

						</td>
                       
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make( 'layouts.reports', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/arbitrage-trading.io/resources/views/reports/finance/referrals_list.blade.php ENDPATH**/ ?>