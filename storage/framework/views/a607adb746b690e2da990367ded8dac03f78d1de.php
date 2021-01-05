<?php $__env->startSection('card-title'); ?>
    <?php if(request('action') =='create'): ?> New Account <?php elseif(request('action') =='edit'): ?> Edit Account <?php else: ?> Account Listing <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-options'); ?>
    <?php if(request('action') == 'listing' || request('action') =='create' || request('action') =='edit'): ?>
        <a href="<?php echo e(route('support',['section' => 'accounts'])); ?>"
           class="btn btn-outline-primary btn-sm">
            Back
        </a>
    <?php else: ?>
        <?php if(user()->club =='*'): ?>
            <a href="<?php echo e(route('support',['section' => 'accounts','action' => 'create'])); ?>"
               class="btn btn-outline-primary btn-sm">
                Create New
            </a>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <?php if(request('action') =='create' || request('action') =='edit' ): ?>
        <small>
            Please fill the details below.
        </small>
        <br>
        <form action="<?php echo e(route('support',['section' => 'accounts','action' => request('action')])); ?>" method="post">
            <?php echo csrf_field(); ?>
            <br>
            <input name="account_id" value="<?php echo e($account->id); ?>" type="hidden">
            <div class="row">
                <div class="col-4">
                    <label>Name</label>
                    <input type="text" name="name" value="<?php echo e(old('name',$account->name)); ?>"
                           class="form-control"
                           placeholder="Name">
                    <?php if($errors->has('name')): ?>
                        <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($errors->first('name')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-4">
                    <label>Account Number</label>
                    <input type="text" name="account" value="<?php echo e(old('account',$account->account)); ?>"
                           class="form-control"
                           placeholder="Account">
                    <?php if($errors->has('account')): ?>
                        <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($errors->first('account')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mt-3" >
                <div class="col-1" style="
    display: none;
">
                    <label>Auth Cookie</label>
                    <input type="text" name="cookie" value="<?php echo e(old('cookie',$account->cookie)); ?>"
                           class="form-control"
                           placeholder="Auth Cookie for account">
                    <?php if($errors->has('cookie')): ?>
                        <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($errors->first('cookie')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                   <div class="col-11">
                    <label>Token Value</label>
                    <input type="text" name="mind_antiddos_" value="<?php echo e(old('mind_antiddos_',$account->mind_antiddos_)); ?>"
                           class="form-control"
                           placeholder="Auth Cookie for account">
                    <?php if($errors->has('mind_antiddos_')): ?>
                        <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($errors->first('mind_antiddos_')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            <br>
            <div class="row mt-3">
                <div class="col-3">
                    <button class="btn btn-outline-primary">Submit Details</button>
                    <?php if($account->exists): ?>
                        <button type="button" class="btn btn-outline-danger"
                                onclick="if(confirm('This action is not reversible, Are you sure?'))  { event.preventDefault(); document.getElementById('delete-form').submit()}">
                            Delete Account
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </form>
        <form id="delete-form"
              action="<?php echo e(route('support',['section' => 'accounts','action' => 'delete','account_id' => $account])); ?>"
              method="POST">
            <?php echo csrf_field(); ?>
        </form>
    <?php else: ?>
        <table class="table table-striped card-table">
            <thead>
            <tr>
                <th class="w-1">#</th>
                <th class="w-1"></th>
                <th>Name</th>
                <th>Account</th>
                <th class="text-left">Created</th>
                  <?php if(user()->acting_role === 'admin'): ?>
                <th class=""></th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($k+1); ?></td>
                    <td><?php if(cache('default_wallet') == $account->id): ?> <i style="font-size: larger;font-weight: bolder" class="text-success"><?php echo paste_icon('check-circle'); ?></i><?php endif; ?>  </td>
                    <td><?php echo e($account->name); ?></td>
                    <td><?php echo e($account->account); ?></td>
                    <td class="text-left"><?php echo e($account->created_at->format('jS M, Y')); ?></td>
                     <?php if(user()->acting_role === 'admin'): ?>
                    <td>
                        <div class="dropdowns">
                            <a href="javascript:void(0)" data-toggle="dropdown" class="" aria-expanded="false"><?php echo paste_icon('more-vertical'); ?></a>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                                 style="position: absolute; transform: translate3d(15px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a href="<?php echo e(route('support',['action' => 'edit','section' => 'accounts','account_id' => $account])); ?>"
                                   class="dropdown-item"><i class="dropdown-icon fe fe-edit-2">
                                    </i> Edit Account </a>
                                <a href="<?php echo e(route('support',['action' => 'default','section' => 'accounts','account_id' => $account])); ?>"
                                   class="dropdown-item"><i class="dropdown-icon fe fe-check-circle">

                                    </i> Set Default Wallet </a>
                            </div>
                        </div>
                    </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        function changePassword() {
            $('#passwordReset').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var client = button.data('name');
                var email = button.data('email');
                var modal = $(this);
                modal.find('.modal-title').text('Password Reset (' + client + ')');
                modal.find('.modal-body p').html(email);
                modal.find('.modal-body input.form-control').val('');
                modal.find('.modal-body input.form-control').on("change paste keyup", function () {
                    checkInputs()
                });
                modal.find('form').attr('action', button.data('url'));

                function checkInputs() {
                    if ($(modal.find('.modal-body input.form-control')[0]).val() === $(modal.find('.modal-body input.form-control')[1]).val()) {
                        modal.find('form button[type=submit]').removeAttr('disabled');
                    } else {
                        modal.find('form button[type=submit]').attr('disabled', "");
                    }
                }

                checkInputs();
            })
        }

        changePassword();

        function changeProfile() {
            $("#profile").trigger('click')
        }

        $(document).ready(function () {
            $("#profile").on('change', function () {
                document.getElementById('wallet-form').submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/percen25/public_html/resources/views/admin/accounts.blade.php ENDPATH**/ ?>