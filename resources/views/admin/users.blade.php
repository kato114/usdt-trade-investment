@extends('admin.page')
@section('card-title')
    @if(request('action') =='create') New Administrator @elseif(request('action') =='edit') Edit Administrator @else Administrator Listing @endif
@endsection
@section('card-options')
    @if(request('action') == 'listing' || request('action') =='create' || request('action') =='edit')
        <a href="{{ route('support',['section' => 'users']) }}"
           class="btn btn-outline-primary btn-sm">
            Back
        </a>
    @else
        @if(user()->acting_role === 'admin')
        <a href="{{ route('support',['section' => 'users','action' => 'create']) }}"
           class="btn btn-outline-primary btn-sm">
            Create New
        </a>
        @endif
    @endif
@endsection
@section('page')
    @if(request('action') =='create' || request('action') =='edit' )
        <div class="card-body">
            <small>
                Please fill the details below.
            </small>
            <br>
            <form enctype="multipart/form-data" id="profile-form" action="{{ route('support',['section' => 'users','action' => request('action')]) }}" method="post">
                @csrf
                <br>
                <input name="user" value="{{ $user->id }}" type="hidden">
				<div class="row no-gutters">
				  <div class="col-lg-4">
				      <div class="card card-profile">
                                <img src="{{ asset('images/background.jpg') }}" class="card-img-top"
                                     alt="Card top image">
                                <div class="card-body text-center">
                    <span class="avatar avatar-xl"
                          style="background-image: url({{ $user->photo }})">
</span>

                                    <h3 class="mb-3">    {{$user->name}}</h3>
                                    <a href="javascript:void(0)" onclick="changeProfile()"
                                       class="btn btn-outline-primary"
                                       style="text-decoration: none">
                                        @icon('camera') Update Image
                                    </a>
                                    <form method="post" id="profile-form" action="{{ route('profile.update') }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input name="image" id="profile" type="file" style="display: none"
                                               accept="image/png, image/jpeg">
                                    </form>
                                </div>
                            </div>
				  </div>
				   <div class="col-lg-8" style="padding-left: 15px;">
                <div class="row">
                    <div class="col-4">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name',$user->name) }}"
                               class="form-control"
                               placeholder="Name">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-4">
                        <label>Email</label>
                        <input type="text" name="email" value="{{ old('email',$user->email) }}"
                               class="form-control"
                               placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="active">Active</option>
                            <option @if(old('status',$user->status) == 'suspended') selected @endif value="suspended">
                                Suspended
                            </option>
                        </select>
                        @if ($errors->has('status'))
                            <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-3">
                        <label>Role</label>
                        <select name="acting_role" class="form-select">
                            <option value="admin">Admin</option>
                            <option @if(old('acting_role',$user->acting_role) == 'manager') selected @endif value="manager">
                                Manager
                            </option>
                        </select>
                        @if ($errors->has('status'))
                            <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $errors->first('acting_role') }}</strong>
                        </span>
                        @endif
                    </div>
                    
                      <label class="custom-control custom-checkbox mt-1">
                                    <input type="checkbox" class="custom-control-input" name="user_mail"
                                           @if(old('user_mail',$user->user_mail) == true) checked="" @endif>
                                    <span class="custom-control-label">Include in Mail</span>
                                </label>
                                
                    
                    
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        <button class="btn btn-outline-primary">Submit</button>
                        @if($user->exists)
                            <button type="button" class="btn btn-outline-danger"
                                    onclick="if(confirm('Are you sure?'))  { event.preventDefault(); document.getElementById('delete-form').submit()}">
                                Delete
                            </button>
                        @endif
                    </div>
                </div>
				</div>
					</div>
				
            </form>
        </div>
        <form id="delete-form"
              action="{{ route('support',['section' => 'users','action' => 'delete','user' => $user]) }}" method="POST">
            @csrf
        </form>
    @else
        <table class="table table-striped card-table">
            <thead>
            <tr>
                <th class="w-1"></th>
                <th>Name</th>
                <th>Email</th>
               
                <th>Acting Role</th>
                
                <th class="text-center">Joined</th>
                @if(user()->acting_role === 'admin')
                <th class=""></th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="text-center">
                        <div class="avatar d-block" style="background-image: url({{ $user->photo }})">
                        </div>
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                   
                    <td>{{@strtoupper($user->acting_role)}}</td>
               
                    <td class="text-left">{{$user->created_at->format('jS M, Y')}}</td>
                    
                    @if(user()->acting_role === 'admin')
                    <td>
                       <div class="dropdowns">
                            <a href="javascript:void(0)" data-toggle="dropdown" class="" aria-expanded="false">@icon('more-vertical')</a>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                <a href="{{ route('support',['action' => 'edit','section' => 'users','user' => $user]) }}"
                                   class="dropdown-item">
                                    <div class="dropdown-item-icon"> @icon('edit')</div>
                                    Edit </a>
                                <a href="#" data-toggle="modal" data-target="#passwordReset"
                                   data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                   data-url="{{ route('support',['action' => 'reset_password','section' => 'users','user' => $user]) }}"
                                   class="dropdown-item">
                                    <div class="dropdown-item-icon">@icon('lock')</div>
                                    </i> Reset Password</a>
                            </div>
                        </div>
                    </td>
                    @endif
                </tr>
            @endforeach
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
                            @csrf
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
	@endsection
