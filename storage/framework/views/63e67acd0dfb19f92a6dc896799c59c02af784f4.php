<?php $__env->startSection('title'); ?>
    Administration
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo $__env->yieldContent('card-title'); ?></h3>
            <div class="card-options">
                <?php echo $__env->yieldContent('card-options'); ?>
            </div>
        </div>
        <?php echo $__env->yieldContent('page'); ?>
    </div>
    <?php echo $__env->yieldContent('other'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/arbitrage-trading.io/resources/views/admin/page.blade.php ENDPATH**/ ?>