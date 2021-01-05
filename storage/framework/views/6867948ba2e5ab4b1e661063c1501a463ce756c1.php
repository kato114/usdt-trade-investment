<div id="w-deposit" class="row mx-0">
	<div class="card col-md-12 px-0">
	    <div class="card-header">
	        <p class="card-title w-100">
	            Transaction Status
	            <button class="btn btn-danger btn-sm btn-back float-right">Back</button>
	        </p>
	    </div>
	    <div class="my-4">
	    	<div class="row">
	    		<div class="col-md-12 text-center">
	    			<p>Payment Information</p>	
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-5 text-right">Status: </div>
	    		<div class="col-md-7">
	    			<p id="status"> Waiting for your funds... </p>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-5 text-right">Total Amount To Send: </div>
	    		<div class="col-md-7">
	    			<p id="amount_sent"><?php echo e(number_format($deposit_request["btc"], 8)); ?> BTC (total confirms needed: 3)</p>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-5 text-right">Received So Far: </div>
	    		<div class="col-md-7">
	    			<p id="amount_sent"><?php echo e(number_format($deposit_request["rbtc"], 8)); ?> BTC (unconfirmed)</p>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-5 text-right">Balance Remaining: </div>
	    		<div class="col-md-7">
	    			<span id="amount_sent"><?php echo e(number_format($deposit_request["btc"] - $deposit_request["rbtc"], 8)); ?> BTC</span>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-12 text-center">
	    			<img src='<?php echo e($deposit_request["qrcode"]); ?>'>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-5 text-right">Send To Address: </div>
	    		<div class="col-md-7">
	    			<p id="amount_sent"><?php echo e($deposit_request["address"]); ?></p>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-5 text-right">Time Left For Us to confirm Funds: </div>
	    		<div class="col-md-7">
	    			<p id="amount_sent">7h 29m 16s</p>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-5 text-right">Payment ID: </div>
	    		<div class="col-md-7">
	    			<p id="amount_sent">3456789876543456789098765</p>
	    			<p>(have this handy if you need any support related to this transaction)</p>
	    		</div>
	    	</div>
	    </div>
	</div>
</div>

<script>
	var deposit_id = "<?php echo e($deposit_request["id"]); ?>";

	$(document).ready(function() {
	    $.ajax({
            type: "GET",
            url: "public/deposit_status/" + deposit_id,
            dataType: 'json',
            success: function (data) {
            	console.log(data);
            }
        });
	});
</script><?php /**PATH E:\xampp\htdocs\25-percent\resources\views/client/status.blade.php ENDPATH**/ ?>