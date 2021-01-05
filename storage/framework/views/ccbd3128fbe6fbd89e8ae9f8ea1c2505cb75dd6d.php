<div id="w-category" class="row mx-0">
	<div id="w-category-deposit" class="card text-white text-center col-md-6 w-item" style="background-color: #5eba00;">
		<div class="w-item-content">
			<div class="w-item-type">D</div>
			<h1>Deposit</h1>
		</div>
	</div>
	<div id="w-category-withdraw" class="card bg-danger text-white text-center col-md-6 w-item" style="background-color: #206bc4;">
		<div class="w-item-content">
			<div class="w-item-type">W</div>
			<h1>Withdraw</h1>
		</div>
	</div>
</div>
<div id="w-deposit" class="row mx-0 d-none">
	<div class="card col-md-12 px-0">
	    <div class="card-header">
	        <p class="card-title w-100">
	            Deposit
	            <button class="btn btn-danger btn-sm btn-back float-right">Back</button>
	        </p>
	    </div>
	    <div class="mb-4">
			<div style="max-width: 500px; margin: 10px auto; padding: 20px;">
                <div id="spinner" class="d-none">
                    <div class="m-9 d-flex justify-content-center ">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div id="wallet" class="row equal data-row wallet d-none">
                    <div class="col-9">
                        <p> Please send the exact amount as shown below, and add your transaction fee to the amount
                            you send. We need to receive the exact amount shown below. A different amount will cause
                            your contribution to be retained until payed in full. </p>
                        <p> This payment address and the amount are valid for 10 minutes. Once this time has
                            passed, if you have not made the payment, the deposit will be canceled. </p>
                        <p>
                            <span class="qr-text">Amount to send</span>
                            <code id="btc-amount" style="font-size: larger"></code> BTC
                        </p>
                        <p>
                            <span class="qr-text">Sending address: </span>
                            <span id="btc-wallet" class="qr-data"></span></span>
                        </p>
                    </div>
                    <div class="col-3 card">
                        <img id="btc-img" style="width: 100%;">
                        <span class="img-caption">You can use this QR code to obtain the wallet address.</span>
                    </div>
                </div>
                <div id="dform">
					<div class="form-group row">
						<label class="col-form-label text-right col-md-4 col-sm-12">Deposit Amount</label>
						<div class="col-md-7 col-sm-12">
							<input type="number" id="damount" class="form-control" placeholder="" style="border-color: darkgray;">
						</div>
					</div>
					<div class="form-group row mb-2 mt-3">
						<input type="button" class="btn btn-primary btn-deposit" value="Generate Deposit Address" style="margin: 0px auto;">
					</div>
				</div>
			</div>
			<div>
	            <?php 
	            	$deposit_request = $client->deposits()->orderByDesc('created_at')->paginate(); 
	            ?>
				<table class="table">
					<thead>
						<tr>
	                        <th>Date (GMT)</th>
							<th>Wallet Address</th>
	                        <th>Requested USD</th>
	                        <th>Requested BTC</th>
	                        <th>Confirmed Amount</th>
							<th>Request Status</th>
						</tr>
					</thead>
					<tbody>
			            <?php if($deposit_request->count()>0): ?>
			           		<?php $__currentLoopData = $deposit_request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			           		<tr>
	                        <td><?php echo e($request->created_at); ?></td>
	                        <td class="wrap" title="<?php echo e($request->address); ?>"><?php echo e($request->address); ?></td>
	                        <td><?php echo e(currency($request->usd,true,2)); ?></td>
	                        <td class="text-danger"><?php echo e(currency($request->btc,true,8)); ?></td>
	                        <td class="text-primary"><?php echo e(currency($request->rbtc,true,8)); ?></td>
	                        <td><?php echo e($request->status); ?></td>
	                    	</tr>
			           		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			           	<?php else: ?>
							<tr>
								<td class="text-center" colspan="5">There is no deposit transaction.</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
	    </div>
	</div>
</div>
<div id="w-withdraw" class="row mx-0 d-none">
	<div class="card col-md-12 px-0">
	    <div class="card-header">
	        <p class="card-title w-100">
	            Withdraw
	            <button class="btn btn-danger btn-sm btn-back float-right">Back</button>
	        </p>
	    </div>
	    <div class="mb-4">
			<div style="max-width: 500px; min-height: 210px; margin: 10px auto; padding: 20px;">
                <div id="wspinner" class="d-none">
                    <div class="m-9 d-flex justify-content-center ">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div id="wform">
					<div class="form-group row my-3">
						<label class="col-form-label text-right col-md-4 col-sm-12">Wallet Address</label>
						<div class="col-md-7 col-sm-12">
							<input type="text" id="waddress" class="form-control" placeholder="" style="border-color: darkgray;">
						</div>
					</div>
					<div class="form-group row my-3">
						<label class="col-form-label text-right col-md-4 col-sm-12">Withdraw Amount</label>
						<div class="col-md-7 col-sm-12">
							<input type="number" id="wamount" class="form-control" placeholder="" style="border-color: darkgray;">
						</div>
					</div>
					<div class="form-group row my-3">
						<input type="button" class="btn btn-primary btn-withdraw" value="Proceed Withdraw" style="margin: 0px auto;">
					</div>
				</div>
			</div>
			<div>
	            <?php 
	            	$withdraw_request = $client->withdrawalRequests()->orderByDesc('created_at')->paginate(); 
	            ?>
				<table class="table">
					<thead>
						<tr>
							<th>Date</th>
							<th>Wallet Address</th>
							<th>Amount</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
			            <?php if($withdraw_request->count()>0): ?>
			           		<?php $__currentLoopData = $withdraw_request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			           		<tr>
	                        <td><?php echo e($request->created_at); ?></td>
	                        <td class="wrap" title="<?php echo e($request->wallet); ?>"><?php echo e($request->wallet); ?></td>
	                        <td><?php echo e(currency($request->amount,true,2)); ?></td>
	                        <td><?php echo e($request->status); ?></td>
	                    	</tr>
			           		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			           	<?php else: ?>
							<tr>
								<td class="text-center" colspan="5">There is no withdraw transaction.</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
	    </div>
	</div>
</div>

<script>
	$('.btn-deposit').on("click", function() {
      	var damount = $("#damount").val();

        if (damount >= 50) {
            $('#spinner').toggleClass('d-none');
            $('#dform').toggleClass('d-none');
            $('#error').toggleClass('d-none');

        	axios.get('<?php echo e(route('mind.deposit',compact('client'))); ?>?amount=' + $("#damount").val())
                .then(function (response) {
                    if (response.status === 200 || response.status === 201) {
                        $('#btc-img').attr('src', response.data.qrcode);
                        $('#btc-amount').html(response.data.btc);
                        $('#btc-wallet').html(response.data.address);
                        $('#spinner').toggleClass('d-none');
                        $('#wallet').toggleClass('d-none');
            			$('#dform').toggleClass('d-none');
                    } else {
                        $('#amount').toggleClass('d-none');
                        $('#spinner').toggleClass('d-none');
            			$('#dform').toggleClass('d-none');
                        $('#error').toggleClass('d-none');
                        $('#error').html(response.statusText);
                    }
                }).catch(function (error) {
	                var response = error.request;
	                $('#spinner').toggleClass('d-none');
            		$('#dform').toggleClass('d-none');
	                $('#error').toggleClass('d-none');
	                $('#error').html(JSON.parse(response.response).message);
            	});
        }
	});

    $('.btn-withdraw').on('click', function (event) {
      	var waddress = $("#waddress").val();
      	var wamount = $("#wamount").val();

        if (waddress.length > 0 && wamount.length > 0) {
            $('#wspinner').toggleClass('d-none');
            $('#wform').toggleClass('d-none');
            $('#error').toggleClass('d-none');

        	axios.get('<?php echo e(route('mind.withdraw',compact('client'))); ?>?amount=' + $("#wamount").val() + '&address=' + $("#waddress").val())
                .then(function (response) {
                    if (response.status === 200 || response.status === 201) {
                        $('#wspinner').toggleClass('d-none');
                        $('#wform').toggleClass('d-none');
            			$('#error').toggleClass('d-none');
                    } else {
                        $('#wspinner').toggleClass('d-none');
            			$('#wform').toggleClass('d-none');
                        $('#error').toggleClass('d-none');
                        $('#error').html(response.statusText);
                    }
                }).catch(function (error) {
	                var response = error.request;
	                $('#wspinner').toggleClass('d-none');
            		$('#wform').toggleClass('d-none');
	                $('#error').toggleClass('d-none');
	                $('#error').html(JSON.parse(response.response).message);
            	});
        }
    });

    $('#w-category-deposit').on('click', function(event) {
    	$('#w-category').toggleClass('d-none');
    	$('#w-deposit').toggleClass('d-none');
    });

    $('#w-category-withdraw').on('click', function(event) {
    	$('#w-category').toggleClass('d-none');
    	$('#w-withdraw').toggleClass('d-none');
    });

    $('.btn-back').on('click', function(event) {
    	$(this).parent().parent().parent().parent().toggleClass('d-none');
    	$('#w-category').toggleClass('d-none');
    })
</script><?php /**PATH E:\xampp\htdocs\25-percent\resources\views/client/wallet.blade.php ENDPATH**/ ?>