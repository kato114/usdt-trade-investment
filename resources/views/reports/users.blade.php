@extends( 'layouts.main')
@section('styles')
    <style>
        @page {
            size: landscape !important;
        }
    </style>
@endsection
@section('title')
    {{$report->title}} <a href="{{ route('report') }}" class="btn btn-info float-right">Back</a>
@endsection
@section('content')
    @if(!isset($users))
        <div class="card">
            <div class="card-header">
                Registered
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <form action="" method="get" class="form-horizontal">
                            {{date_picker('From', 'from',coalesce($from,\Carbon\Carbon::parse('first day of jan')->format('Y-m-d')))}}
                            {{date_picker('Date To', 'to',\Carbon\Carbon::now()->toDateString())}}

                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
                                <a href="{{url('reports')}}" class="btn btn-outline-primary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card">
            <table class="table card-table table-striped table-bordered">
                <thead>
                <tr>
                    <td>#</td>
                    <td>User</td>
                    <td>Phone</td>
                    <td>E-Mail</td>
                    <td>Registered</td>
                </tr>
                </thead>
                <tbody>
                @foreach($users->cursor() as $x => $user)
                    <tr>
                        <td><i>{{$x+1}}</i></td>
                        <td>
                            @if(user()->club =='*')
                                <a
                                        href="{{ route('support',['section' =>'users','action' => 'edit' ,'user' => $user]) }}">{{$user->name}}</a>
                            @else
                                {{$user->name}}
                            @endif
                        </td>
                        <td>{{$user->phone}}</td>
                        <td><a href="mailto:{{ $user->email }}">{{$user->email}}</a></td>
                        <td>{{$user->created_at->format('jS M, Y')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection