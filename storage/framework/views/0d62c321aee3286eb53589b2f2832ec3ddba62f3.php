<?php $__env->startSection('body'); ?>
    <style>
        .bg {
            background-size: cover;
            min-height: 100vh;
            background: white url(<?php echo e(asset('images/background.jpg')); ?>)  no-repeat;
        }
    </style>
    <div class="page bg">
        <div class="page-single mt-7">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/real-profits.com/resources/views/layouts/single.blade.php ENDPATH**/ ?>