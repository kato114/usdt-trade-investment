
<?php $__env->startSection('card-title'); ?>
    <?php if(request('action') =='create'): ?> New Client <?php elseif(request('action') =='edit'): ?> Edit Client <?php else: ?> Client Listing <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-options'); ?>
    <?php if(request('action') == 'listing' || request('action') =='create' || request('action') =='edit'): ?>
        <a href="<?php echo e(route('support',['section' => 'clients'])); ?>"
           class="btn btn-outline-primary btn-sm">
            Back
        </a>
    <?php else: ?>
        <?php if(user()->club =='*' && user()->acting_role === 'admin'): ?>
            <a href="<?php echo e(route('support',['section' => 'clients','action' => 'create'])); ?>"
               class="btn btn-outline-primary btn-sm">
                Create New
            </a>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <?php if(request('action') =='create' || request('action') =='edit' ): ?>
        <div class="card-body">
            <small>
                Please fill the details below.
            </small>
            <br>
            <form enctype="multipart/form-data" id="profile-form"
                  action="<?php echo e(route('support',['section' => 'clients','action' => request('action')])); ?>" method="post">
                <?php echo csrf_field(); ?>
                <br>
                <div class="row no-gutters">
                    <?php if($client->exists): ?>
                        <div class="col-lg-4">

                            <div class="card card-profile">
                                <img src="<?php echo e(asset('images/background.jpg')); ?>" class="card-img-top"
                                     alt="Card top image">
                                <div class="card-body text-center">
                    <span class="avatar avatar-xl"
                          style="background-image: url(<?php echo e($client->photo); ?>)">
</span>

                                    <h3 class="mb-3">    <?php echo e($client->name); ?></h3>
                                    <a href="javascript:void(0)" onclick="changeProfile()"
                                       class="btn btn-outline-primary"
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
                    <?php endif; ?>
                    <div class="col-lg-8 pl-2">
                        <input name="client" value="<?php echo e($client->id); ?>" type="hidden">
                        <div class="row">
                            <div class="col-6">
                                <label>Name</label>
                                <input type="text" name="name" value="<?php echo e(old('name',$client->name)); ?>"
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
                                <input type="text" name="email" value="<?php echo e(old('email',$client->email)); ?>"
                                       class="form-control"
                                       placeholder="Email">
                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-5">
                                <label>Status</label>
                                <select name="status" class="form-select">
                                    <option value="active">Active</option>
                                    <option <?php if(old('status',$client->status) == 'suspended'): ?> selected
                                            <?php endif; ?> value="suspended">
                                        Suspended
                                    </option>
                                </select>
                                <?php if($errors->has('status')): ?>
                                    <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($errors->first('status')); ?></strong>
                        </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-3">
                                <label>% Profit to Receive</label>
                                <input type="number" name="commission"
                                       value="<?php echo e(old('commission',$client->commission)); ?>"
                                       class="form-control"
                                       placeholder="% Profit to Receive">
                                <?php if($errors->has('profits')): ?>
                                    <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($errors->first('profits')); ?></strong>
                        </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-auto">
                                <label>&nbsp;</label>

                                <label class="custom-control custom-checkbox mt-1">
                                    <input type="checkbox" class="custom-control-input" name="client_deposit_total"
                                           <?php if(old('client_deposit_total',$client->client_deposit_total) == true): ?> checked="" <?php endif; ?>>
                                    <span class="custom-control-label">Include in Client Deposit Total</span>
                                </label><br>
                                     <label class="custom-control custom-checkbox mt-1">
                                    <input type="checkbox" class="custom-control-input" name="client_mail"
                                           <?php if(old('client_mail',$client->client_mail) == true): ?> checked="" <?php endif; ?>>
                                    <span class="custom-control-label">Include in Mail</span>
                                </label>
                            </div>
                            
                           
                            
                        </div>
                   
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-label">Notes</label>
                                    <textarea class="form-control" name="notes" rows="6"
                                              placeholder="Content.."><?php echo e(old('notes',$client->notes)); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <button class="btn btn-outline-primary">Submit Details</button>
                                <?php if($client->exists): ?>
                                    <button type="button" class="btn btn-outline-danger"
                                            onclick="if(confirm('This action is not reversible, Are you sure?'))  { event.preventDefault(); document.getElementById('delete-form').submit()}">
                                        Delete Account
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form id="delete-form"
                  action="<?php echo e(route('support',['section' => 'clients','action' => 'delete','client' => $client])); ?>"
                  method="POST">
                <?php echo csrf_field(); ?>
            </form>
        </div>
    <?php else: ?>
        <table class="table card-table table-striped">
            <thead>
            <tr>
                <th class="w-1"></th>
                <th>Name</th>
                <th>Email</th>
                <th>Profit %</th>
                <th class="text-left">Joined</th>
                <?php if(user()->acting_role === 'admin'): ?>
                <th class=""></th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="table-vcenter">
                    <td class="text-center">
                        <div class="avatar d-block" style="background-image: url(<?php echo e($client->photo); ?>)">
                        </div>
                    </td>
                    <td><a data-turbolinks="false"
                           href="<?php echo e(route('client', compact('client'))); ?>"> <?php echo e($client->name); ?></a></td>
                    <td><?php echo e($client->email); ?></td>
                    <td><?php echo e(currency( $client->commission)); ?></td>
                    <td class="text-left"><?php echo e($client->created_at->format('jS M, Y')); ?></td>
                    <?php if(user()->acting_role === 'admin'): ?>
                    <td>
                        <div class="dropdowns">
                            <a href="javascript:void(0)" data-toggle="dropdown" class="" aria-expanded="false"><?php echo paste_icon('more-vertical'); ?></a>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                <a href="<?php echo e(route('support',['action' => 'edit','section' => 'clients','client' => $client])); ?>"
                                   class="dropdown-item">
                                    <div class="dropdown-item-icon"> <?php echo paste_icon('edit'); ?></div>
                                    Edit </a>
                                <a href="#" data-toggle="modal" data-target="#passwordReset"
                                   data-name="<?php echo e($client->name); ?>" data-email="<?php echo e($client->email); ?>"
                                   data-url="<?php echo e(route('support',['action' => 'reset_password','section' => 'clients','client' => $client])); ?>"
                                   class="dropdown-item">
                                    <div class="dropdown-item-icon"><?php echo paste_icon('lock'); ?></div>
                                    </i> Reset Password</a>
                            </div>
                        </div>
                    </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="modal fade" id="passwordReset" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST" action="">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Password Reset</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email:</label>
                                <p class="form-control"></p>
                            </div>
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label class="col-form-label">New Password:</label>
                                <input required type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Password Confirmation:</label>
                                <input type="password" name="password-confirmation" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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

        changePassword()
    </script>
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

<?php echo $__env->make('admin.page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/arbitrage-trading.io/resources/views/admin/clients.blade.php ENDPATH**/ ?>