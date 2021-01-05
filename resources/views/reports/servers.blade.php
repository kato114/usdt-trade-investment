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
    <div class="card">
        <table class="table card-table table-striped table-bordered">
            <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Ip</td>
                <td>Provider Link</td>
                <td>Added</td>
            </tr>
            </thead>
            <tbody>
            @foreach($servers->cursor() as $x => $server)
                <tr>
                    <td><i>{{$x+1}}</i></td>
                    <td><a
                                href="{{ route('support',['section' =>'servers','action' => 'edit' ,'server' => $server]) }}">{{$server->name}}</a>
                    </td>
                    <td>{{$server->ip}}</td>
                    <td class="wrap"><a href="{{ $server->link?: '#' }}" target="_blank"> {{$server->link?: "Not Available"}} </a>
                    </td>
                    <td>{{$server->created_at->format('jS M, Y')}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection