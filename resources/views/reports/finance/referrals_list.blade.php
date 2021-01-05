@extends( 'layouts.reports')
@section('title')
    {{$report->title}}
    <a href="{{ route('report') }}"
       class="btn btn-info float-right">Back</a>
@endsection
@section('content')
    <div class="card">
        <table class="table card-table table-striped table-bordered">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Client</td>
					
                    <td>Referal Name</td>
                 
                </tr>
                </thead>
                <tbody>
                @foreach($clients->cursor() as $x => $client)
				<?php //die(print_r());?>
                    <tr>
                        <td><i>{{$x+1}}</i></td>
                        <td><a
                                    href="{{ route('client',['client' => $client]) }}">{{$client->name}}</a>
                        </td>
						
                        <td>
						    @inject('provider', 'App\Http\Controllers\ClientController')
                             
      {!! $provider::rname($client->id) !!}
						</td>
                       
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
@endsection
