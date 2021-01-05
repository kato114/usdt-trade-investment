<?php $__env->startSection('card-title'); ?>
    Registration Requests (<?php echo e(ucfirst(request('status','pending'))); ?>)
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-options'); ?>
    <?php if(request('status') == 'approved'): ?>
        <a href="<?php echo e(route('support',['section' => 'requests'])); ?>"
           class="btn btn-outline-primary btn-sm mr-2">
            Pending
        </a>
        <a href="<?php echo e(route('support',['section' => 'requests','status' =>'rejected'])); ?>"
           class="btn btn-outline-primary btn-sm">
            Rejected
        </a>
    <?php elseif(request('status') == 'rejected'): ?>
        <a href="<?php echo e(route('support',['section' => 'requests'])); ?>"
           class="btn btn-outline-primary btn-sm mr-2">
            Pending
        </a>
        <a href="<?php echo e(route('support',['section' => 'requests','status' =>'approved'])); ?>"
           class="btn btn-outline-primary btn-sm btn-success">
            Approved
        </a>
    <?php elseif(request('status','pending') == 'pending'): ?>
        <a href="<?php echo e(route('support',['section' => 'requests','status' =>'rejected'])); ?>"
           class="btn btn-outline-primary btn-sm mr-2">
            Rejected
        </a>
        <a href="<?php echo e(route('support',['section' => 'requests','status' =>'approved'])); ?>"
           class="btn btn-outline-primary btn-sm btn-success">
            Approved
        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <?php $__currentLoopData = $registrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php //dd($request);?>
    <!-- row code start -->
    <div class="row">
        
        	<div class="card card-aside col-6">
          <img src="<?php echo e(optional($request->selfieProof)->link?: \App\Photo::avatar()); ?>" width="300px">
		  </div>
        
        <div class="card card-aside col-6">
            <a href="#" class="card-aside-column w-50"
               style="background-image: url(<?php echo e(optional($request->selfieProof)->link?: \App\Photo::avatar()); ?>)"></a>
            <div class="card-body d-flex flex-column">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td>
                            <b> Applicant </b>
                        </td>
                        <td>
                            <?php echo e($request->name); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Email </b>
                        </td>
                        <td>
                            <?php echo e($request->email); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Phone </b>
                        </td>
                        <td>
                            <?php echo e($request->phone); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> <?php echo e($request->id_type); ?> </b>
                        </td>
                        <td>
                            <?php echo e($request->id_number); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Address </b>
                        </td>
                        <td>
                            <?php echo e($request->residential_address); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Referee </b>
                        </td>
                        <td>
                            <?php echo e($request->referee); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Proof of Address </b>
                        </td>
                        <td>
                            <a target="_blank" href="<?php echo e(optional($request->addressProof)->link); ?>">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Proof of Identity </b>
                        </td>
                        <td>
                            <a target="_blank"
                               href="<?php echo e(optional( $request->idNumberProof)->link?: \App\Photo::avatar()); ?>">View</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                 <?php if(user()->acting_role === 'admin'): ?>
                <div class="d-flex align-items-center pt-5 mt-auto">
                    <div class="ml-auto text-muted">
                    
                        <a
                            href="<?php echo e(route('support',['action' => 'dismiss','section' => 'requests','request' => $request])); ?>"
                            class="d-md-inline-block btn btn-primary"><i class="dropdown-icons fe fe-x"></i> Dismiss </a>
                        <a href="<?php echo e(route('support',['action' => 'confirm','section' => 'requests','request' => $request])); ?>"
                           class="ml-3 d-md-inline-block btn btn-primary"><i class="dropdown-icons fe fe-check-circle"></i>
                            Confirm
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        
        
        
        </div>
        <!-- row code ends -->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Reject Transaction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email" class="col-form-label">Client:</label>
                            <p class="form-control"></p>
                        </div>
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label class="col-form-label">Reason:</label>
                            <textarea name="reason" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Transaction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email" class="col-form-label">Client:</label>
                            <p id="client" class="form-control"></p>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-form-label">Wallet ID:</label>
                            <p id="wallet" class="form-control"></p>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Transaction ID:</label>
                            <p id="txn" class="form-control"></p>
                        </div>
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label class="col-form-label">Amount:</label>
                            <input name="amount" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <?php echo e(date_picker('Transaction Date','date',now()->toDateTimeString())); ?>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        function rejectRequest() {
            $('#reject').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var client = button.data('name');
                var modal = $(this);
                modal.find('.modal-title').text('Reject Request (' + client + ')');
                modal.find('.modal-body p').html(client);
                modal.find('form').attr('action', button.data('url'));
            })
        }

        rejectRequest();

        function confirmRequest() {
            $('#confirm').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var client = button.data('name');
                var amount = button.data('amount');
                var type = button.data('type');
                var txn = button.data('txn');
                var wallet = button.data('wallet');
                var modal = $(this);
                modal.find('.modal-title').text('Confirm ' + type + ' Request (' + client + ')');
                modal.find('#client').html(client);
                modal.find('#wallet').html(wallet);
                modal.find('#txn').html(txn);
                modal.find('.modal-body input[name=amount]').val(amount);
                modal.find('form').attr('action', button.data('url'));
            })
        }

        confirmRequest();
        rejectRequest()
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/my-passive-income.net/resources/views/admin/registrations.blade.php ENDPATH**/ ?>