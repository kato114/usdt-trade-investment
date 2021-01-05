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
    @if(!isset($clients))
        <div class="card">
            <div class="card-header">
                Registered
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <form action="" method="get" class="form-horizontal">
                            <div class="form-group">
                                <label>Select Clubs</label>
                                <br>
                                @foreach($clubs as $club)
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" checked name="clubs[]" class="custom-control-input"
                                               value="{{ $club }}">
                                        <span class="custom-control-label">{{ $club }}</span>
                                    </label>
                                @endforeach
                            </div>
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
                    <td>Client</td>
                    <td>E-Mail</td>
                    <td>Registered</td>
                </tr>
                </thead>
                <tbody>
                @foreach($clients->cursor() as $x => $client)
                    <tr>
                        <td><i>{{$x+1}}</i></td>
                        <td><a
                                    href="{{ route('client',['client' => $client]) }}">{{$client->name}}</a>
                        </td>
                        <td><a href="mailto:{{ $client->email }}">{{$client->email}}</a></td>
                        <td>{{$client->created_at->format('jS M, Y')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
