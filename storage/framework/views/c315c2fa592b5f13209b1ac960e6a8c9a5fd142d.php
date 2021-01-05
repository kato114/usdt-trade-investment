<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col col-login mx-auto">
                <div class="text-center mb-6">
                    <img src="<?php echo e(asset('images/logo.svg')); ?>" class="h-6" alt="">
                </div>
                <form class="card" action="<?php echo e(route('password.update',['guard' => request('guard')])); ?>" method="post">
                    <div class="card-body p-6">
                        <div class="card-title"><?php echo e(__('Reset Password')); ?></div>
                        <?php if(session('status')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="token" value="<?php echo e($token); ?>">
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
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input id="password" placeholder="New Password" type="password"
                                   class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                                   name="password" value="<?php echo e(old('password')); ?>" required autofocus>

                            <?php if($errors->has('password')): ?>
                                <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password Confirmation</label>
                            <input id="email" placeholder="Password Confirmation"
                                   class="form-control" type="password"
                                   name="password_confirmation" value="" required autofocus>
                        </div>
                        <?php echo csrf_field(); ?>
                        <div class="form-footer">
                            <button type="submit"
                                    class="mt-6 btn btn-primary btn-block"><?php echo e(__('Reset Password')); ?></button>
                        </div>
                    </div>
                </form>
                
                
                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.single', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/real-profits.com/resources/views/auth/passwords/reset.blade.php ENDPATH**/ ?>