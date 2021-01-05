@extends('admin.page')
@section('card-title')
    @if(request('action') =='create') New Account @elseif(request('action') =='edit') Edit Account @else Account Listing @endif
@endsection
@section('card-options')
    @if(request('action') == 'listing' || request('action') =='create' || request('action') =='edit')
        <a href="{{ route('support',['section' => 'accounts']) }}"
           class="btn btn-outline-primary btn-sm">
            Back
        </a>
    @else
        @if(user()->club =='*')
            <a href="{{ route('support',['section' => 'accounts','action' => 'create']) }}"
               class="btn btn-outline-primary btn-sm">
                Create New
            </a>
        @endif
    @endif
@endsection
@section('page')
    @if(request('action') =='create' || request('action') =='edit' )
        <small>
            Please fill the details below.
        </small>
        <br>
        <form action="{{ route('support',['section' => 'accounts','action' => request('action')]) }}" method="post">
            @csrf
            <br>
            <input name="account_id" value="{{ $account->id }}" type="hidden">
            <div class="row">
                <div class="col-4">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name',$account->name) }}"
                           class="form-control"
                           placeholder="Name">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-4">
                    <label>Account Number</label>
                    <input type="text" name="account" value="{{ old('account',$account->account) }}"
                           class="form-control"
                           placeholder="Account">
                    @if ($errors->has('account'))
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $errors->first('account') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row mt-3" >
                <div class="col-1" style="
    display: none;
">
                    <label>Auth Cookie</label>
                    <input type="text" name="cookie" value="{{ old('cookie',$account->cookie) }}"
                           class="form-control"
                           placeholder="Auth Cookie for account">
                    @if ($errors->has('cookie'))
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $errors->first('cookie') }}</strong>
                        </span>
                    @endif
                </div>
                   <div class="col-11">
                    <label>Token Value</label>
                    <input type="text" name="mind_antiddos_" value="{{ old('mind_antiddos_',$account->mind_antiddos_) }}"
                           class="form-control"
                           placeholder="Auth Cookie for account">
                    @if ($errors->has('mind_antiddos_'))
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $errors->first('mind_antiddos_') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <br>
            <div class="row mt-3">
                <div class="col-3">
                    <button class="btn btn-outline-primary">Submit Details</button>
                    @if($account->exists)
                        <button type="button" class="btn btn-outline-danger"
                                onclick="if(confirm('This action is not reversible, Are you sure?'))  { event.preventDefault(); document.getElementById('delete-form').submit()}">
                            Delete Account
                        </button>
                    @endif
                </div>
            </div>
        </form>
        <form id="delete-form"
              action="{{ route('support',['section' => 'accounts','action' => 'delete','account_id' => $account]) }}"
              method="POST">
            @csrf
        </form>
    @else
        <table class="table table-striped card-table">
            <thead>
            <tr>
                <th class="w-1">#</th>
                <th class="w-1"></th>
                <th>Name</th>
                <th>Account</th>
                <th class="text-left">Created</th>
                  @if(user()->acting_role === 'admin')
                <th class=""></th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($accounts as $k => $account)
                <tr>
                    <td>{{ $k+1 }}</td>
                    <td>@if(cache('default_wallet') == $account->id) <i style="font-size: larger;font-weight: bolder" class="text-success">@icon('check-circle')</i>@endif  </td>
                    <td>{{$account->name}}</td>
                    <td>{{$account->account}}</td>
                    <td class="text-left">{{$account->created_at->format('jS M, Y')}}</td>
                     @if(user()->acting_role === 'admin')
                    <td>
                        <div class="dropdowns">
                            <a href="javascript:void(0)" data-toggle="dropdown" class="" aria-expanded="false">@icon('more-vertical')</a>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                                 style="position: absolute; transform: translate3d(15px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a href="{{ route('support',['action' => 'edit','section' => 'accounts','account_id' => $account]) }}"
                                   class="dropdown-item"><i class="dropdown-icon fe fe-edit-2">
                                    </i> Edit Account </a>
                                <a href="{{ route('support',['action' => 'default','section' => 'accounts','account_id' => $account]) }}"
                                   class="dropdown-item"><i class="dropdown-icon fe fe-check-circle">

                                    </i> Set Default Wallet </a>
                            </div>
                        </div>
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection

@section('scripts')
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
@endsection
