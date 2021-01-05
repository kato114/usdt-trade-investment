@extends('admin.page')
@section('card-title')
    Registration Requests ({{ ucfirst(request('status','pending')) }})
@endsection
@section('card-options')
    @if(request('status') == 'approved')
        <a href="{{ route('support',['section' => 'requests']) }}"
           class="btn btn-outline-primary btn-sm mr-2">
            Pending
        </a>
        <a href="{{ route('support',['section' => 'requests','status' =>'rejected']) }}"
           class="btn btn-outline-primary btn-sm">
            Rejected
        </a>
    @elseif(request('status') == 'rejected')
        <a href="{{ route('support',['section' => 'requests']) }}"
           class="btn btn-outline-primary btn-sm mr-2">
            Pending
        </a>
        <a href="{{ route('support',['section' => 'requests','status' =>'approved']) }}"
           class="btn btn-outline-primary btn-sm btn-success">
            Approved
        </a>
    @elseif(request('status','pending') == 'pending')
        <a href="{{ route('support',['section' => 'requests','status' =>'rejected']) }}"
           class="btn btn-outline-primary btn-sm mr-2">
            Rejected
        </a>
        <a href="{{ route('support',['section' => 'requests','status' =>'approved']) }}"
           class="btn btn-outline-primary btn-sm btn-success">
            Approved
        </a>
    @endif
@endsection
@section('page')
    @foreach($registrations as $request)
    <?php //dd($request);?>
    <!-- row code start -->
    <div class="row">
        
        	<div class="card card-aside col-6">
          <img src="{{ optional($request->selfieProof)->link?: \App\Photo::avatar() }}" width="300px">
		  </div>
        
        <div class="card card-aside col-6">
            <a href="#" class="card-aside-column w-50"
               style="background-image: url({{ optional($request->selfieProof)->link?: \App\Photo::avatar() }})"></a>
            <div class="card-body d-flex flex-column">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td>
                            <b> Applicant </b>
                        </td>
                        <td>
                            {{ $request->name }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Email </b>
                        </td>
                        <td>
                            {{ $request->email }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Phone </b>
                        </td>
                        <td>
                            {{ $request->phone }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> {{$request->id_type}} </b>
                        </td>
                        <td>
                            {{ $request->id_number }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Address </b>
                        </td>
                        <td>
                            {{ $request->residential_address }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Referee </b>
                        </td>
                        <td>
                            {{ $request->referee }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Proof of Address </b>
                        </td>
                        <td>
                            <a target="_blank" href="{{ optional($request->addressProof)->link }}">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Proof of Identity </b>
                        </td>
                        <td>
                            <a target="_blank"
                               href="{{ optional( $request->idNumberProof)->link?: \App\Photo::avatar() }}">View</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                 @if(user()->acting_role === 'admin')
                <div class="d-flex align-items-center pt-5 mt-auto">
                    <div class="ml-auto text-muted">
                    
                        <a
                            href="{{ route('support',['action' => 'dismiss','section' => 'requests','request' => $request]) }}"
                            class="d-md-inline-block btn btn-primary"><i class="dropdown-icons fe fe-x"></i> Dismiss </a>
                        <a href="{{ route('support',['action' => 'confirm','section' => 'requests','request' => $request]) }}"
                           class="ml-3 d-md-inline-block btn btn-primary"><i class="dropdown-icons fe fe-check-circle"></i>
                            Confirm
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        
        
        
        </div>
        <!-- row code ends -->
    @endforeach
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
                        @csrf
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
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label">Amount:</label>
                            <input name="amount" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            {{ date_picker('Transaction Date','date',now()->toDateTimeString()) }}
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
@endsection

@section('scripts')
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
@endsection
