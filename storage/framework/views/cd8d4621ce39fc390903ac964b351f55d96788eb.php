<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row" style="margin-top: 30vh;">
            <div class="col col-login mx-auto">
                <div class="card">
                    <div class="card-header"><?php echo e(__('Your details have been received.')); ?></div>
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            <?php echo e(__('We will review your details and get back to you shortly')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        setTimeout(function(){
              window.location ='<?php echo e(url('https://25-percent.com/')); ?>';
        },5000)
    </script>
<?php $__env->appendSection(); ?>

<?php echo $__env->make('layouts.signin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/percen25/public_html/resources/views/auth/registered.blade.php ENDPATH**/ ?>