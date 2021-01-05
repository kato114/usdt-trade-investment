<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col col-md-5 col-sm-12 mx-auto" style="margin-top: 20vh;">
              <div class="signin-wrapper">
                <div class="signin-wrapper-header text-center">
                  <div class="logo"><img src="<?php echo e($client->photo); ?>" alt="image" style="border-radius: 50%;"></div>
                  <h3 class="title"><?php echo e($client->name); ?></h3>
                  <a class="pl-0" href="<?php echo e(route('password.request', ['guard' => $client->role])); ?>">
                    <?php echo e(__('I forgot my Password')); ?>

                  </a>
                </div>
                <form class="card" action="<?php echo e(route('login')); ?>" method="post">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="email" value="<?php echo e($client->email); ?>">
                  <input type="hidden" name="guard" value="<?php echo e($client->role); ?>">
                  <div class="form-group">
                    <label for="signinPass">Password*</label>
                    <input type="password" class="form-control <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" id="signinPass" name="password" value="" required autofocus placeholder="Password">
                    <?php if($errors->has('password')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <div class="custom-checkbox">
                      <input type="checkbox" name="id-1" id="id-1" checked>
                      <label for="id-1">Remember Password</label>
                      <span class="checkbox"></span>
                    </div>
                  </div>
                  <div class="form-group">
                      <a class="col-4 float-left btn btn-sm btn-secondary" href="<?php echo e(route('login')); ?>">
                        <?php echo e(__('Not Me')); ?>

                      </a>
                      <button type="submit" class="col-4 float-right btn btn-sm btn-primary btn-hover">Log In</button>
                  </div>
                </form>
                <div class="signin-wrapper-footer">
                  <p class="bottom-text">Don’t have an account? <a href="<?php echo e(route('register')); ?>" data-toggle="modal" data-target="#signUpModal" data-dismiss="modal" aria-label="Close">Sign Up Now</a></p>
                </div>
              </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.signin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\25-percent\resources\views/auth/login/password.blade.php ENDPATH**/ ?>