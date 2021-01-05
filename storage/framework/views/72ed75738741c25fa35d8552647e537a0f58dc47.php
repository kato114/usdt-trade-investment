<?php $__env->startSection('styles'); ?>
    <style>
        @page  {
            size: landscape !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e($report->title); ?> <a href="<?php echo e(route('report')); ?>" class="btn btn-info float-right">Back</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(!isset($clients)): ?>
        <div class="card">
            <div class="card-header">
                Registered
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <form action="" method="get" class="form-horizontal">
                            <div class="form-group">
                                <label>Select Clubs</label>
                                <br>
                                <?php $__currentLoopData = $clubs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $club): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" checked name="clubs[]" class="custom-control-input"
                                               value="<?php echo e($club); ?>">
                                        <span class="custom-control-label"><?php echo e($club); ?></span>
                                    </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
                                <a href="<?php echo e(url('reports')); ?>" class="btn btn-outline-primary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="card">
            <table class="table card-table table-striped table-bordered">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Client</td>
                    <td>E-Mail</td>
                    <td>Registered</td>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $clients->cursor(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><i><?php echo e($x+1); ?></i></td>
                        <td><a
                                    href="<?php echo e(route('client',['client' => $client])); ?>"><?php echo e($client->name); ?></a>
                        </td>
                        <td><a href="mailto:<?php echo e($client->email); ?>"><?php echo e($client->email); ?></a></td>
                        <td><?php echo e($client->created_at->format('jS M, Y')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make( 'layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/real-profits.com/resources/views/reports/clients.blade.php ENDPATH**/ ?>