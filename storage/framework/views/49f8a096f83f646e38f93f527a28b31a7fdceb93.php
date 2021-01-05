

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
                    <div class="card-body">
                        <div class="card-header mb-5"><?php echo e(__('Choose ID')); ?></div>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('login.verify',['email' => $client->email,'guard' => $client->role])); ?>">
                                <div class="form-group">
                                    <div class="media">
                                        <img class="mr-3" src="<?php echo e($client->photo); ?>" style="width: 50px">
                                        <div class="media-body">
                                            <h5><?php echo e($client->name); ?><span class="ml-2 badge badge-primary"><?php if($client->role == 'admin'): ?>
                                                        Admin <?php else: ?> Client <?php endif; ?></span></h5>
                                            <h6><?php echo e($client->phone); ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-group">
                            <a class="btn btn-outline-primary" href="<?php echo e(route('login')); ?>">
                                <?php echo e(__('Not Me')); ?>

                            </a>
                        </div>
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

<?php echo $__env->make('layouts.signin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/percen25/public_html/resources/views/auth/login/choose.blade.php ENDPATH**/ ?>