<div id="w-category" class="row mx-0">
	<div id="w-category-deposit" class="card text-white text-center col-md-6 w-item" style="background-color: #5eba00;">
		<div class="w-item-content">
			<div class="w-item-type">D</div>
			<h1>Deposit</h1>
		</div>
	</div>
	<div class="col-md-6 p-0">
		<div id="w-category-withdraw-capital" class="card text-white text-center w-item" style="width: 100%; height: calc(50vh - 150px); background-color: #206bc4;">
			<div class="w-item-content">
				<div class="w-item-type">W</div>
				<h1>Capital Withdraw</h1>
			</div>
		</div>
		<div id="w-category-withdraw-profit" class="card text-white text-center w-item" style="width: 100%; height: calc(50vh - 150px); background-color: #206bc4;">
			<div class="w-item-content">
				<div class="w-item-type">W</div>
				<h1>Profit Withdraw</h1>
			</div>
		</div>
	</div>
</div>
<div id="w-deposit" class="row mx-0 d-none">
	<div class="card col-md-12 px-0">
	    <div class="card-header">
	        <p class="card-title w-100">
	            Deposit
	            <button class="btn btn-primary btn-sm btn-back float-right">Back</button>
	        </p>
	    </div>
	    <div class="mb-4">
			<div style="margin: 10px auto; padding: 20px;">
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
                   <p>
                      Please understand that all deposits are locked in for a 14 day period before being available for withdrawal. 
                   </p>
                   Deposits will become active on Sundays. 
                   </p>
                   Minimum deposit 50 USD, Maximum deposit 100,000 USD <br>
                   There is no limit on account size, or number of deposits.
                   </p>
                   <label class="custom-control custom-checkbox">
                   <input type="checkbox" class="custom-control-input" name="example-checkbox2"
                      value="option2">
                   <span
                      class="custom-control-label">&nbsp;&nbsp;I agree to send the amount in one payment</span>
                   </label>
                   <br>
                   <!--f2-->
                   <label class="custom-control custom-checkbox">
                   <input type="checkbox" class="custom-control-input" name="example-checkbox3"
                      value="option3">
                   <span
                      class="custom-control-label">&nbsp;&nbsp;I Agree to send payment within 5 minutes</span>
                   </label>
                   <!-- f2 end-->
                   <br>
                   <!--f3-->
                   <label class="custom-control custom-checkbox">
                   <input type="checkbox" class="custom-control-input" name="example-checkbox4"
                      value="option4">
                   <span
                      class="custom-control-label">&nbsp;&nbsp;I agree to a 1% fee</span>
                   </label>
                   <!-- f3 end-->
                   <br>
                   <!--f4-->
                   <label class="custom-control custom-checkbox">
                   <input type="checkbox" class="custom-control-input" name="example-checkbox5"
                      value="option5">
                   <span
                      class="custom-control-label">&nbsp;&nbsp;I understand that after 30 minutes the rate can change</span>
                   </label>
                   <!-- f4 end-->
                   <p>
                      On the next page you will see your bitcoin invoice. Please make sure you have enough in your bitcoin wallet ready
                      to pay this invoice.
                   </p>
                   <label class="custom-control custom-checkbox">
                   <input type="checkbox" class="custom-control-input" name="example-checkbox1"
                      value="option1">
                   <span
                      class="custom-control-label">&nbsp;&nbsp;By sending this deposit I am accepting these terms.</span>
                   </label>
                   <div class="invalid-feedback bog d-none">Agree to terms first!</div>
                   <div class="row form-group mx-0">
                      <label class="col-form-label float-left mr-5">Amount USD:</label>
                      <input type="number" name="damount" step="0.01" id="damount" class="form-control float-left" style="border-color: darkgray; width:200px;">
                   </div>
                   <p>
                      If you need help with the bitcoin transfer please contact: <a
                         href="mailto:support@real-profits.com">support@25-percent.com</a> for
                      assistance.
                   </p>
                    <div class="bg-danger error d-none text-white text-xl-center"></div>
                   <div class="form-group row mb-2 mt-3">
                      <input type="button" class="btn btn-primary btn-deposit" value="Submit Request" style="margin: 0px auto;">
                   </div>
                </div>
			</div>
			<div>
	            @php 
	            	$deposit_request = $client->deposits()->orderByDesc('created_at')->paginate(); 
	            @endphp
				<table class="table table-hover">
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
			            @if($deposit_request->count()>0)
			           		@foreach($deposit_request as $key => $request)
			           		<tr class='clickable-row' data-href='{{ route('client', array('client' => $client, 'action' => 'status','rid' => $request->id)) }}' style='cursor:pointer;'>
	                        <td>{{ $request->created_at }}</td>
	                        <td class="wrap" title="{{ $request->address }}">{{ $request->address }}</td>
	                        <td>{{ currency($request->usd,true,2) }}</td>
	                        <td class="text-danger">{{ currency($request->btc,true,8) }}</td>
	                        <td class="text-primary">{{ currency($request->rbtc,true,8) }}</td>
	                        <td>{{ $request->status }}</td>
	                    	</tr>
			           		@endforeach
			           	@else
							<tr>
								<td class="text-center" colspan="5">There is no deposit transaction.</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
	    </div>
	</div>
</div>
<div id="w-withdraw-capital" class="row mx-0 d-none">
	<div class="card col-md-12 px-0">
	    <div class="card-header">
	        <p class="card-title w-100">
	            Capital Withdraw
	            <button class="btn btn-primary btn-sm btn-back float-right">Back</button>
	        </p>
	    </div>
	    <div class="mb-4">
			<div style="min-height: 210px; margin: 10px auto; padding: 20px;">
                <div id="wspinner-capital" class="d-none">
                    <div class="m-9 d-flex justify-content-center ">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div id="wform-capital">
                    <p> Please complete the form below. </p>
                    <p> Capital withdrawals can be requested at any time. </p>
                    <p> <strong>Withdrawal request will be paid 2 weeks form this Sunday.</strong></p>
                    <p> There is no fee charged for withdrawals. </p>
                    <p> <strong>Maximum withdrawal ammount $ {{currency( normalize( $client->balance),true,2)}}</strong></p>
					<div class="form-group row my-3 mx-0">
						<label class="col-form-label text-right float-left mr-4" style="width: 150px;">Wallet Address : </label>
						<div class="float-left" style="max-width: 200px;">
							<input type="text" class="form-control waddress" placeholder="" style="border-color: darkgray;">
						</div>
					</div>
					<div class="form-group row my-3 mx-0">
						<label class="col-form-label text-right float-left mr-4" style="width: 150px;">Withdraw Amount : </label>
						<div class="float-left" style="max-width: 200px;">
							<input type="number" class="form-control wamount" placeholder="" style="border-color: darkgray;">
						</div>
					</div>
                    <p>If you have any questions please send an email to: <a
                            href="mailto:support@real-profits.com">support@25-percent.com</a> for assistance.
                    </p>
					<input type="hidden" class="form-control type" value="Capital withdrawal">
					<div class="form-group row my-3">
						<input type="button" class="btn btn-primary btn-withdraw-capital" value="Proceed Withdraw" style="margin: 0px auto;">
					</div>
				</div>
			</div>
			<div>
	            @php 
	            	$withdraw_request = $client->withdrawalRequests()->orderByDesc('created_at')->paginate(); 
	            @endphp
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
			            @if($withdraw_request->count()>0)
			           		@foreach($withdraw_request as $key => $request)
			           		@if($request->withdraw_type1 == "Capital withdrawal")
			           		<tr>
	                        <td>{{ $request->created_at }}</td>
	                        <td class="wrap" title="{{ $request->wallet }}">{{ $request->wallet }}</td>
	                        <td>{{ currency($request->amount,true,2) }}</td>
	                        <td>{{ $request->status }}</td>
	                    	</tr>
							@endif
			           		@endforeach
			           	@else
							<tr>
								<td class="text-center" colspan="5">There is no withdraw transaction.</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
	    </div>
	</div>
</div>
<div id="w-withdraw-profit" class="row mx-0 d-none">
	<div class="card col-md-12 px-0">
	    <div class="card-header">
	        <p class="card-title w-100">
	            Profit Withdraw
	            <button class="btn btn-primary btn-sm btn-back float-right">Back</button>
	        </p>
	    </div>
	    <div class="mb-4">
			<div style="min-height: 210px; margin: 10px auto; padding: 20px;">
                <div id="wspinner-profit" class="d-none">
                    <div class="m-9 d-flex justify-content-center ">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div id="wform-profit">
                    <p> Please complete the form below. </p>
                    <p> Profit Withdrawal can be made as soon as you have $50. </p>
                    <p> <strong>Withdrawals will be paid within 24 hrs.</strong></p>
                    <p> There is no fee charged for withdrawals. </p>
                    <p> <strong>Maximum withdrawal ammount $ {{currency( normalize( $client->balance),true,2)}}</strong></p>
					<div class="form-group row my-3 mx-0">
						<label class="col-form-label text-right float-left mr-4" style="width: 150px;">Wallet Address : </label>
						<div class="float-left" style="max-width: 200px;">
							<input type="text" class="form-control waddress" placeholder="" style="border-color: darkgray;">
						</div>
					</div>
					<div class="form-group row my-3 mx-0">
						<label class="col-form-label text-right float-left mr-4" style="width: 150px;">Withdraw Amount : </label>
						<div class="float-left" style="max-width: 200px;">
							<input type="number" class="form-control wamount" placeholder="" style="border-color: darkgray;">
						</div>
					</div>
                    <p>If you have any questions please send an email to: <a
                            href="mailto:support@real-profits.com">support@25-percent.com</a> for assistance.
                    </p>
					<input type="hidden" class="form-control type" value="Profit withdrawal">
					<div class="form-group row my-3">
						<input type="button" class="btn btn-primary btn-withdraw-profit" value="Proceed Withdraw" style="margin: 0px auto;">
					</div>
				</div>
			</div>
			<div>
	            @php 
	            	$withdraw_request = $client->withdrawalRequests()->orderByDesc('created_at')->paginate(); 
	            @endphp
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
			            @if($withdraw_request->count()>0)
			           		@foreach($withdraw_request as $key => $request)
			            	@if($request->withdraw_type1 == "Profit withdrawal")
			           		<tr>
	                        <td>{{ $request->created_at }}</td>
	                        <td class="wrap" title="{{ $request->wallet }}">{{ $request->wallet }}</td>
	                        <td>{{ currency($request->amount,true,2) }}</td>
	                        <td>{{ $request->status }}</td>
	                    	</tr>
							@endif
			           		@endforeach
			           	@else
							<tr>
								<td class="text-center" colspan="5">There is no withdraw transaction.</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
	    </div>
	</div>
</div>

<script>
    var type = "{{ request('type') }}";
    var status_url = "{{ route('client', array('client' => $client, 'action' => 'status')) }}";
    
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });

	$('.btn-deposit').on("click", function() {
      	var damount = $("#damount").val();
      	var final = '';
        $('.custom-control-input:checked').each(function(){        
            var values = $(this).val();
            final += values;
        });

        if (final === 'option2option3option4option5option1' && damount >= 50) {
            $('#spinner').toggleClass('d-none');
            $('#dform').toggleClass('d-none');
            $('#error').toggleClass('d-none');

        	axios.get('{{ route('mind.deposit',compact('client')) }}?amount=' + $("#damount").val())
                .then(function (response) {
                    if (response.status === 200 || response.status === 201) {
                        document.location.href = status_url + "&rid=" +  response.data.id;
                    } else {
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

    $('.btn-withdraw-capital').on('click', function (event) {
      	var waddress = $(this).parent().parent().find('.waddress').val();
      	var wamount = $(this).parent().parent().find('.wamount').val();
      	var wtype = $(this).parent().parent().find('.type').val();

        if (waddress.length > 0 && wamount.length > 0) {
            $('#wspinner-capital').toggleClass('d-none');
            $('#wform-capital').toggleClass('d-none');
            $('#error-capital').toggleClass('d-none');

        	axios.get('{{ route('mind.withdraw',compact('client')) }}?amount=' + wamount + '&address=' + waddress + '&type=' + wtype)
                .then(function (response) {
                    if (response.status === 200 || response.status === 201) {
                        $('#wspinner-capital').toggleClass('d-none');
                        $('#wform-capital').toggleClass('d-none');
            			$('#error-capital').toggleClass('d-none');
                    } else {
                        $('#wspinner-capital').toggleClass('d-none');
            			$('#wform-capital').toggleClass('d-none');
                        $('#error-capital').toggleClass('d-none');
                        $('#error-capital').html(response.statusText);
                    }
                }).catch(function (error) {
	                var response = error.request;
	                $('#wspinner-capital').toggleClass('d-none');
            		$('#wform-capital').toggleClass('d-none');
	                $('#error-capital').toggleClass('d-none');
	                $('#error-capital').html(JSON.parse(response.response).message);
            	});
        }
    });

    $('.btn-withdraw-profit').on('click', function (event) {
      	var waddress = $(this).parent().parent().find('.waddress').val();
      	var wamount = $(this).parent().parent().find('.wamount').val();
      	var wtype = $(this).parent().parent().find('.type').val();

        if (waddress.length > 0 && wamount.length > 0) {
            $('#wspinner-profit').toggleClass('d-none');
            $('#wform-profit').toggleClass('d-none');
            $('#error-profit').toggleClass('d-none');

        	axios.get('{{ route('mind.withdraw',compact('client')) }}?amount=' + wamount + '&address=' + waddress + '&type=' + wtype)
                .then(function (response) {
                    if (response.status === 200 || response.status === 201) {
                        $('#wspinner-profit').toggleClass('d-none');
                        $('#wform-profit').toggleClass('d-none');
            			$('#error-profit').toggleClass('d-none');
                    } else {
                        $('#wspinner-profit').toggleClass('d-none');
            			$('#wform-profit').toggleClass('d-none');
                        $('#error-profit').toggleClass('d-none');
                        $('#error-profit').html(response.statusText);
                    }
                }).catch(function (error) {
	                var response = error.request;
	                $('#wspinner-profit').toggleClass('d-none');
            		$('#wform-profit').toggleClass('d-none');
	                $('#error-profit').toggleClass('d-none');
	                $('#error-profit').html(JSON.parse(response.response).message);
            	});
        }
    });

    $('#w-category-deposit').on('click', function(event) {
    	$('#w-category').toggleClass('d-none');
    	$('#w-deposit').toggleClass('d-none');
    });

    $('#w-category-withdraw-capital').on('click', function(event) {
    	$('#w-category').toggleClass('d-none');
    	$('#w-withdraw-capital').toggleClass('d-none');
    });

    $('#w-category-withdraw-profit').on('click', function(event) {
    	$('#w-category').toggleClass('d-none');
    	$('#w-withdraw-profit').toggleClass('d-none');
    });

    $('.btn-back').on('click', function(event) {
    	$(this).parent().parent().parent().parent().toggleClass('d-none');
    	$('#w-category').toggleClass('d-none');
    })
    
    if(type == "deposit")
    {
    	$('#w-category').toggleClass('d-none');
    	$('#w-deposit').toggleClass('d-none');
    }
    else if(type == "withdraw")
    {
    	$('#w-category').toggleClass('d-none');
    	$('#w-withdraw-profit').toggleClass('d-none');
    }
</script>