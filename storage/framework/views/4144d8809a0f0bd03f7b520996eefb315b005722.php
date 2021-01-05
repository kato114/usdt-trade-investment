<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col col-md-5 col-sm-12 mx-auto" style="margin-top: 20vh;">
              <div class="signin-wrapper">
                <div class="signin-wrapper-header text-center">
                  <div class="logo"><img src="<?php echo e(asset('images/logo.png')); ?>" alt="image"></div>
                  <h3 class="title">Login with</h3>
                  <p>Welcome back, please sign in below</p>
                </div>
                <form class="card" action="<?php echo e(route('login.verify')); ?>" method="get">
                  <?php echo csrf_field(); ?>
                  <div class="form-group">
                    <label for="signinEmail">Email*</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus placeholder="Enter your Email">
                    <?php if($errors->has('email')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                  </div>
                  <button type="submit" class="btn btn-primary btn-hover">Log In</button>
                </form>
                <div class="signin-wrapper-footer">
                  <p class="bottom-text">Don’t have an account? <a href="<?php echo e(route('register')); ?>" data-toggle="modal" data-target="#signUpModal" data-dismiss="modal" aria-label="Close">Sign Up Now</a></p>
                </div>
              </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.signin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\25-percent\resources\views/auth/login/verify.blade.php ENDPATH**/ ?>