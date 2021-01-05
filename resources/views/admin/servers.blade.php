@extends('admin.page')
@section('card-title')
    @if(request('action') =='create') New Server @elseif(request('action') =='edit') Edit Server @else Server Listing @endif
@endsection
@section('card-options')
    @if(request('action') == 'listing' || request('action') =='create' || request('action') =='edit')
        <a href="{{ route('support',['section' => 'servers']) }}"
           class="btn btn-outline-primary btn-sm">
            Back
        </a>
    @else
        <a href="{{ route('support',['section' => 'servers','action' => 'create']) }}"
           class="btn btn-outline-primary btn-sm">
            Create New
        </a>
    @endif
@endsection
@section('page')
    @if(request('action') =='create' || request('action') =='edit' )
        <small>
            Please fill the details below.
        </small>
        <br>
        <form action="{{ route('support',['section' => 'servers','action' => request('action')]) }}" method="post">
            @csrf
            <br>
            <input name="server" value="{{ $server->id }}" type="hidden">
            <div class="row">
                <div class="col-4">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name',$server->name) }}"
                           class="form-control"
                           placeholder="Server Name">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-4">
                    <label>Ip Address</label>
                    <input type="text" name="ip" value="{{ old('ip',$server->ip) }}"
                           class="form-control"
                           placeholder="IP Address">
                    @if ($errors->has('ip'))
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $errors->first('ip') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4">
                    <label>Provider Link</label>
                    <input type="text" name="link" value="{{ old('link',$server->link) }}"
                           class="form-control"
                           placeholder="Provider Link">
                    @if ($errors->has('link'))
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $errors->first('link') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-3">
                    <button class="btn btn-outline-primary">Submit</button>
                    @if($server->exists)
                        <button type="button" class="btn btn-outline-danger"
                                onclick="if(confirm('Are you sure?'))  { event.preventDefault(); document.getElementById('delete-form').submit()}">
                            Delete
                        </button>
                    @endif
                </div>
            </div>
        </form>
        <form id="delete-form"
              action="{{ route('support',['section' => 'servers','action' => 'delete','server' => $server]) }}"
              method="POST">
            @csrf
        </form>
    @else
        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th>Name</th>
                <th>IP</th>
                <th>Provider Link</th>
                <th class="text-left">Created</th>
                <th class=""></th>
            </tr>
            </thead>
            <tbody>
            @foreach($servers as $server)
                <tr>
                    <td>{{$server->name}}</td>
                    <td>{{$server->ip}}</td>
                    <td class="wrap"><a href="{{ $server->link?: '#' }}" target="_blank" title="{{ $server->link?: "Not Available" }}"> {{$server->link?: "Not Available"}} </a></td>
                    <td class="text-left">{{$server->created_at->format('jS M, Y')}}</td>
                    <td>
                        <a class="icon"
                           href="{{ route('support',['action' => 'edit','section' => 'servers','server' => $server]) }}">
                            <i class="fe fe-edit"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
