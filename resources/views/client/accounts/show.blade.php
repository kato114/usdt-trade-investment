@extends('layouts.main')
@section('title')
    Edit Account
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            Account Details
            <div class="card-options">
                <button type="button"
                        onclick=" if (confirm('Are you sure?')) {document.getElementById('deleteForm').submit() } "
                        class="btn btn-outline-danger btn-sm">
                    Delete Account
                </button>
            </div>
        </div>
        <div class="card-body">
            <small>
                Please fill the details below.
            </small>
            <form action="{{ route('account.update',compact('client','account')) }}" method="post">
                @csrf
                @method('put')
                <div class="row mt-3">
                    <div class="col-4">
                        <label>Account Number</label>
                        <input type="text" name="account"
                               value="{{ old('account',$account->account) }}"
                               class="form-control d-inline"
                               placeholder="Account Number">
                        @if ($errors->has('account'))
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('account') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="col-6">
                        <label>Account Name</label>
                        <input type="text" name="name"
                               value="{{ old('name',$account->name) }}"
                               class="form-control d-inline"
                               placeholder="Account Name">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        <label>Holding Server</label>
                        <select name="server_id" class="form-select">
                            <option value="">Select Server</option>
                            @foreach($servers as $server)
                                <option value="{{$server->id}}"
                                        @if(old('server_id',$account->server_id) == $server->id) selected @endif>{{ $server->name }}</option>
                            @endforeach
                        </select> @if ($errors->has('server_id'))
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('server_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        <label>Commission Currency</label>
                        <select name="commission_currency" class="form-select">
                            <option value="">Select Currency</option>
                            @foreach(['USD','GBP','AUD','CHF','EUR','THB'] as $currency)
                                <option value="{{$currency}}"
                                        @if(old('commission_currency',$account->commission_currency) == $currency) selected @endif>{{ $currency }}</option>
                            @endforeach
                        </select> @if ($errors->has('commission_currency'))
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('commission_currency') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-3">
                        <label>Account Commission</label>
                        <input type="number" step="0.01" name="commission"
                               value="{{ old('commission',$account->commission) }}"
                               class="form-control d-inline"
                               placeholder="Commission">
                        @if ($errors->has('commission'))
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('commission') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <label>Other Commission Emails</label>
                        <input type="text" name="cc"
                               value="{{ old('cc', implode(', ' ,$account->cc?: [])) }}"
                               class="form-control d-inline"
                               placeholder="Other commission emails">
                        @if ($errors->has('cc'))
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('cc') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <button class="btn btn-primary">Submit Application</button>
                        <a href="{{ route('client',compact('client')) }}" class="btn btn-outline-primary">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
            <form action="{{ route('account.destroy',compact('client','account')) }}" id="deleteForm" method="post">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
