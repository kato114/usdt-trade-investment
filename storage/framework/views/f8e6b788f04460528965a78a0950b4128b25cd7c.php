<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col col-md-4 col-sm-12 mx-auto">
                <div class="text-center mb-6">
                    <img src="<?php echo e(asset('images/logo.svg')); ?>" class="h-6" alt="">
                </div>
                <div class="card">
                    <form method="POST" action="<?php echo e(route('login')); ?>" class="card-body">
                        <?php echo csrf_field(); ?>
                        <div class="form-group m-5 row">

                            <div class="row mb-3">
                                <div class="col-auto">
                                    <span class="avatar avatar-lg"
                                          style="background-image: url(<?php echo e($client->photo); ?>)"></span>
                                </div>
                                <div class="col">
                                    <div class="mb-2">
                                        <h5><?php echo e($client->name); ?>

                                        </h5>
                                        <small><?php echo e($client->phone); ?></small>
                                        <br>
                                        <a class="pl-0"
                                           href="<?php echo e(route('password.request', ['guard' => $client->role])); ?>">
                                            <?php echo e(__('I forgot my Password')); ?>

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="email" value="<?php echo e($client->email); ?>">
                        <input type="hidden" name="guard" value="<?php echo e($client->role); ?>">
                        <div class="form-group m-5 row">
                            <div class="col-12">
                                <input id="password" type="password"
                                       class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                                       name="password" value="" required autofocus>

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-12 mt-3">
                                <a class="btn btn-secondary" href="<?php echo e(route('login')); ?>">
                                    <?php echo e(__('Not Me')); ?>

                                </a>
                                <button class="float-right btn btn-primary">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.single', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/my-passive-income.net/resources/views/auth/login/password.blade.php ENDPATH**/ ?>