<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col col-md-4 col-sm-12 mx-auto">
                <div class="text-center mb-6">
                    <img src="<?php echo e(asset('images/logo.svg')); ?>" class="h-6" alt="">
                </div>
                <form class="card" action="<?php echo e(route('login.verify')); ?>" method="post">
                    <div class="card-body">
                        <div class="card-header mb-5"><?php echo e(__('Choose ID')); ?></div>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('login.verify',['email' => $client->email,'guard' => $client->role])); ?>">
                                <div class="form-group">
                                    <div class="media">
                                        <img class="mr-3" src="<?php echo e($client->photo); ?>" style="width: 50px">
                                        <div class="media-body">
                                            <h5><?php echo e($client->name); ?><span class="ml-2 badge badge-primary"><?php if($client->role == 'admin'): ?>
                                                        Admin <?php else: ?> Client <?php endif; ?></span></h5>
                                            <h6><?php echo e($client->phone); ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-group">
                            <a class="btn btn-outline-primary" href="<?php echo e(route('login')); ?>">
                                <?php echo e(__('Not Me')); ?>

                            </a>
                        </div>
                    </div>
                </form>
           
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.single', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/real-profits.com/resources/views/auth/login/choose.blade.php ENDPATH**/ ?>