<?php $__env->startSection('title'); ?>
    Add Referral
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            Account Details
        </div>
        <div class="card-body">
            <small>
                Please fill the details below.
            </small>
            <form action="<?php echo e(route('referral',compact('client'))); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row mt-3">
                    <div class="col-4 form-group">
                        <label>Account Number</label>
                        <div class="input-icon mb-3">
                            <input type="text" name="account" value="<?php echo e(old('account')); ?>" class="form-control"
                                   placeholder="Search for...">
                            <span class="input-icon-addon">
                            <div class="spinner-border d-none spinner-border-sm text-primary" role="status">
  <span class="sr-only">Loading...</span>
</div>
                            </span>
                        </div>

                        <?php if($errors->has('account_id')): ?>
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($errors->first('account_id')); ?></strong>
                                    </span>
                        <?php endif; ?>
                    </div>
                    <div class="col-6">
                        <label>Account Name</label>
                        <p id="accountName" class="form-control">Not Available</p>
                        <?php if($errors->has('name')): ?>
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                        <?php endif; ?>
                    </div>
                    <input name="account_id" type="hidden">
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <button class="btn btn-primary">Submit Application</button>
                        <a href="<?php echo e(route('client',compact('client'))); ?>?&action=referrals" class="btn btn-outline-primary">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function () {
            $('input[name=account]').on('change', function () {
                search($(this).val());
            }).on('keyup', function () {
                search($(this).val());
            });
        });

        function search(val) {
            $('.spinner-border').toggleClass("d-none");
            axios.get('?query=' + val)
                .then(function (response) {
                    $("#accountName").html("{0} [{1}]".format(response.data.name, response.data.email));
                    $('input[name=account_id]').val(response.data.id);
                })
                .catch(function (error) {
                    $("#accountName").html("N/A");
                    $('input[name=account_id]').val("");
                }).then(function () {
                $('.spinner-border').toggleClass("d-none");
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/arbitrage-trading.io/resources/views/client/accounts/referral.blade.php ENDPATH**/ ?>