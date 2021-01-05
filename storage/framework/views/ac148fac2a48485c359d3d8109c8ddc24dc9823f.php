<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col col-10 mx-auto">
                <form method="POST" class="card" enctype="multipart/form-data" action="<?php echo e(route('register')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="card-body p-6">
                        <div class="card-title">Create your account</div>
                        <div class="row">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="name" class="col-form-label"><?php echo e(__('Name')); ?></label>

                                    <input id="name" type="text"
                                           class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                           name="name"
                                           value="<?php echo e(old('name')); ?>" required autofocus>
                                    <?php if($errors->has('name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="email"
                                           class="col-form-label"><?php echo e(__('E-Mail Address')); ?></label>
                                    <input id="email" type="email"
                                           class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                                           name="email" value="<?php echo e(old('email')); ?>" required>

                                    <?php if($errors->has('email')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="email"
                                           class="col-form-label"><?php echo e(__('Phone Number')); ?></label>
                                    <input id="phone" type="phone"
                                           class="form-control<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>"
                                           name="phone" value="<?php echo e(old('phone')); ?>" required>
                                    <?php if($errors->has('phone')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('phone')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="email"
                                           class="col-form-label"><?php echo e(__('Address')); ?></label>
                                    <input id="phone" type="text"
                                           class="form-control<?php echo e($errors->has('address') ? ' is-invalid' : ''); ?>"
                                           name="address" value="<?php echo e(old('address')); ?>" required>

                                    <?php if($errors->has('address')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('address')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email"
                                           class="col-form-label"><?php echo e(__('Referee')); ?> (Name of person that referred you), If nobody referred you please enter "None"</label>
                                    <input id="phone" type="text"
                                           class="form-control<?php echo e($errors->has('referee') ? ' is-invalid' : ''); ?>"
                                           name="referee" value="<?php echo e(old('referee')); ?>" required>
                                    <?php if($errors->has('referee')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('referee')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="email"
                                           class="col-form-label"><?php echo e(__('ID Type')); ?></label>
                                    <select name="id_type" class="form-select">
                                        <option>National ID</option>
                                        <option <?php if(old('type_id')=='Passport ID'): ?> selected <?php endif; ?>>Passport ID
                                        </option>
                                    </select>

                                    <?php if($errors->has('id_type')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('id_type')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="password"
                                           class="col-form-label"><?php echo e(__('Number')); ?></label>
                                    <input id="number" type="text"
                                           value="<?php echo e(old('number')); ?>"
                                           class="form-control<?php echo e($errors->has('number') ? ' is-invalid' : ''); ?>"
                                           name="number" required>

                                    <?php if($errors->has('number')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('number')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="password-confirm"
                                           class="col-form-label text-md-right"><?php echo e(__('Password')); ?></label>
                                    <input id="password" type="password" class="form-control"
                                           name="password" required>
                                    <?php if($errors->has('password')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="password-confirm"
                                           class="col-form-label text-md-right"><?php echo e(__('Confirm Password')); ?></label>

                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                    <?php if($errors->has('password_confirmation')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <table class="table">
                            <tr>
                                <td>
                                    <label for="password-confirm"
                                           class="col-form-label text-md-right"><?php echo e(__('Selfie Photo holding ID')); ?></label>
                                </td>
                                <td>
                                    <input id="selfie" required type="file"
                                           name="selfie">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="password-confirm"
                                           class="col-form-label text-md-right"><?php echo e(__('Photo of ID')); ?></label></td>
                                <td>
                                    <input id="photo_id" required type="file"
                                           name="photo_id">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="password-confirm"
                                           class="col-form-label text-md-right"><?php echo e(__('Proof Address (Less than 90 days old)')); ?></label>
                                </td>
                                <td>
                                    <input id="proof_address" required type="file"
                                           name="proof_address">
                                </td>
                            </tr>
                        </table>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <?php echo e(__('Register')); ?>

                            </button>
                        </div>
                    </div>
                </form>
                <div class="text-center">
                    <a href="<?php echo e(route('login')); ?>" class="text-white"> Already have account? Sign in</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.single', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/real-profits.com/resources/views/auth/register.blade.php ENDPATH**/ ?>