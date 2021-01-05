<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col col-login mx-auto">
                <div class="text-center mb-6">
                    <img src="<?php echo e(asset('images/logo.svg')); ?>" class="h-6" alt="">
                </div>
                <form class="card" action="<?php echo e(route('password.email',['guard' =>request('guard','client')] )); ?>"
                      method="post">
                    <div class="card-body p-6">
                        <div class="card-title"><?php echo e(__('Reset Password')); ?></div>
                        <?php if(session('status')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label class="form-label">Email address</label>
                            <input id="email" placeholder="Email/Phone"
                                   class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                                   name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                            <?php if($errors->has('email')): ?>
                                <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                        <?php echo csrf_field(); ?>

                        <div class="form-footer">
                            <button type="submit"
                                    class="mt-6 btn btn-primary btn-block"><?php echo e(__('Send Password Reset Link')); ?></button>
                        </div>
                    </div>
                </form>
                
                
                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <?php if(request()->isMethod('post')): ?>
        <script>
            setTimeout(function () {
                window.location = '<?php echo e(url('https://investing-club.net')); ?>';
            }, 5000)
        </script>
    <?php endif; ?>
<?php $__env->appendSection(); ?>

<?php echo $__env->make('layouts.single', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/my-passive-income.net/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>