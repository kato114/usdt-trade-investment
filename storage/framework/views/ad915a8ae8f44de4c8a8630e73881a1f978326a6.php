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
    <?php if(!isset($users)): ?>
        <div class="card">
            <div class="card-header">
                Registered
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <form action="" method="get" class="form-horizontal">
                            <?php echo e(date_picker('From', 'from',coalesce($from,\Carbon\Carbon::parse('first day of jan')->format('Y-m-d')))); ?>

                            <?php echo e(date_picker('Date To', 'to',\Carbon\Carbon::now()->toDateString())); ?>


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
                    <td>User</td>
                    <td>Phone</td>
                    <td>E-Mail</td>
                    <td>Registered</td>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $users->cursor(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><i><?php echo e($x+1); ?></i></td>
                        <td>
                            <?php if(user()->club =='*'): ?>
                                <a
                                        href="<?php echo e(route('support',['section' =>'users','action' => 'edit' ,'user' => $user])); ?>"><?php echo e($user->name); ?></a>
                            <?php else: ?>
                                <?php echo e($user->name); ?>

                            <?php endif; ?>
                        </td>
                        <td><?php echo e($user->phone); ?></td>
                        <td><a href="mailto:<?php echo e($user->email); ?>"><?php echo e($user->email); ?></a></td>
                        <td><?php echo e($user->created_at->format('jS M, Y')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/real-profits.com/resources/views/reports/users.blade.php ENDPATH**/ ?>