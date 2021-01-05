<?php $__env->startSection('styles'); ?>
    <style>
        @page  {
            size: landscape !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e($report->title); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/percen25/public_html/resources/views/layouts/reports.blade.php ENDPATH**/ ?>