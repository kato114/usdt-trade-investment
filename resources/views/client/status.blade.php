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
	    			<p id="tran_status">
	    			@if($deposit_request["status"] == "pending")
	    			    Waiting for your funds...
	    			@else
	    			    Complete
	    			@endif
	    			</p>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-5 text-right">Total Amount To Send: </div>
	    		<div class="col-md-7">
	    			<p><span id="amount_sent">{{ number_format($deposit_request["btc"], 8) }}</span> BTC (total confirms needed: 3)</p>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-5 text-right">Received So Far: </div>
	    		<div class="col-md-7">
	    			<p><span id="amount_received">{{ number_format($deposit_request["rbtc"], 8) }}</span> BTC (<span id="confirm_num">unconfirmed</span>)</p>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-5 text-right">Balance Remaining: </div>
	    		<div class="col-md-7">
	    			<p><span id="amount_remain">{{ number_format($deposit_request["btc"] - $deposit_request["rbtc"], 8) }}</span> BTC</p>
	    		</div>
	    	</div>
	        @if($deposit_request["status"] == "pending")
	    	<div class="row" id="qrcode">
	    		<div class="col-md-12 text-center">
	    			<img src='{{ $deposit_request["qrcode"] }}'>
	    		</div>
	    	</div>
	    	@endif
	    	<div class="row">
	    		<div class="col-md-5 text-right">Send To Address: </div>
	    		<div class="col-md-7">
	    			<p>{{ $deposit_request["address"] }}</p>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-5 text-right">Time Left For Us to confirm Funds: </div>
	    		<div class="col-md-7">
	    			<p id="txn_time">0h 0m 0s</p>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-5 text-right">Transaction ID: </div>
	    		<div class="col-md-7">
	    			<div id="txids"></div>
	    			<p>(have this handy if you need any support related to this transaction)</p>
	    		</div>
	    	</div>
	    </div>
	</div>
</div>

<script>
	var deposit_id = "{{ $deposit_request["id"] }}";

	$(document).ready(function() {
    	axios.get("{{ route('deposit_status', $deposit_request['id']) }}")
            .then(function (response) {
                if (response.status === 200 || response.status === 201) {
                    var rdata = response.data.data;
                    var rstatus = response.data.status;

                    if (rstatus === "success") {
                        if(rdata != undefined) {
                            $("#qrcode").hide();
                            
                            $("#tran_status").html("Waiting for confirms...");

                            if(rdata.confirmations > 0)
                                $("#confirm_num").html("Comfirmed: " + rdata.confirmations);

                            if(rdata.confirmations > 3)
                                $("#tran_status").html("Complete");  

                            $("#amount_received").html(rdata.amount);
                            
                            $("#amount_remain").html($("#amount_sent").html() - rdata.amount);

                            $("#txids").empty();
                            for(var i = 0; i < rdata.txids.length; i++)
                            {
                                $("#txids").append('<p>' + rdata.txids[i] + '</p>');
                            }
                        }
                        else 
                        {
                            $("#tran_status").html("Waiting for your funds...");
                        }
                    }
                }
            }).catch(function (error) {
                console.log(error);
        	});
	});
</script>