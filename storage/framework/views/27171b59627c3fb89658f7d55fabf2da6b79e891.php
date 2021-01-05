<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col col-md-4 col-sm-12 mx-auto">
                <div class="text-center mb-6">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" class="h-6" alt="">
                </div>
                <form class="card" action="<?php echo e(route('login.verify')); ?>" method="get">
                    <div class="card-body p-6">
                        <div class="card-title">Login to your account</div>
                        <div class="form-group">
                            <label class="form-label">Email address or Phone</label>
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
                            <button type="submit" class="mt-6 btn btn-primary btn-block">Sign in</button>
                        </div>
                    </div>
                </form>
                <div class="text-center text-white">
                    <a href="<?php echo e(route('register')); ?>" class="text-white" style="
    font-size: 1.6em;
">  Don't have account yet? Sign up</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.single', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/real-profits.com/resources/views/auth/login/verify.blade.php ENDPATH**/ ?>