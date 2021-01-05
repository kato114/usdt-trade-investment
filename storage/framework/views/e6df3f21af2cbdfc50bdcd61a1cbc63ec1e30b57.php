<?php $__env->startSection('title'); ?>
    <?php echo e($user->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-profile">
                <img src="<?php echo e(asset('images/background.jpg')); ?>" class="card-img-top" alt="Card top image">
                <div class="card-body text-center">
                    <span class="avatar avatar-xl"
                          style="background-image: url(<?php echo e(auth()->user()->photo); ?>)">
</span>

                    <h3 class="mb-3">    <?php echo e($user->name); ?></h3>
                    <a href="javascript:void(0)" onclick="changeProfile()" class="btn btn-outline-primary"
                       style="text-decoration: none">
                        <?php echo paste_icon('camera'); ?> Update Image
                    </a>
                    <form method="post" id="profile-form" action="<?php echo e(route('profile.update')); ?>"
                          enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input name="image" id="profile" type="file" style="display: none"
                               accept="image/png, image/jpeg">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-shadow" style="border-radius: 4px;overflow: hidden">
                        <div class="card-header">
                            Personal Details
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo e(route('profile.update')); ?>">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Name</label>
                                        <input type="text" name="name" value="<?php echo e(old('name',$user->name)); ?>"
                                               class="form-control"
                                               placeholder="Name">
                                        <?php if($errors->has('name')): ?>
                                            <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-6">
                                        <label>Email</label>
                                        <input type="text" name="email" value="<?php echo e(old('email',$user->email)); ?>"
                                               class="form-control d-inline"
                                               placeholder="Email">
                                        <?php if($errors->has('email')): ?>
                                            <span class="invalid-feedback d-block" role="alert">
                                                 <strong><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php echo csrf_field(); ?>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="password">
                    <div class="card card-shadow" style="border-radius: 4px;overflow: hidden">
                        <div class="card-header">
                            Change Password
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo e(route('password.change')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-12">
                                        <label>Current Password</label>
                                        <input type="password" name="current_password" value=""
                                               class="form-control"
                                               placeholder="Current Password">
                                        <?php if($errors->has('current_password')): ?>
                                            <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($errors->first('current_password')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <label>New Password</label>
                                        <input type="password" name="password" value=""
                                               class="form-control d-inline"
                                               placeholder="New Password">
                                        <?php if($errors->has('password')): ?>
                                            <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-6">
                                        <label>Password Confirmation</label>
                                        <input type="password" name="password_confirmation" value=""
                                               class="form-control d-inline"
                                               placeholder="Password Confirmation">
                                        <?php if($errors->has('password_confirmation')): ?>
                                            <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button class="btn btn-primary">Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        function changeProfile() {
            $("#profile").trigger('click')
        }

        $(document).ready(function () {
            $("#profile").on('change', function () {
                document.getElementById('profile-form').submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/my-passive-income.net/resources/views/auth/profile.blade.php ENDPATH**/ ?>