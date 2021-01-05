@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $ticket->subject }}</h3>
            <div class="card-options">
                @if(user()->role=='admin')
                    <a href="{{ route('support.resolution') }}" class="btn btn-secondary btn-sm">Back</a>
                @else
                    <a href="{{ route('support.ticket') }}" class="btn btn-secondary btn-sm">Back</a>
                @endif
            </div>
        </div>
        <div class="p-5">
            <div class="media">
                <div class="media-object avatar avatar-md mr-4"
                     style="background-image: url({{ $ticket->client->photo }})"></div>
                <div class="media-body">
                    <div class="media-heading">
                        <small class="float-right text-muted">{{ $ticket->created_at->diffForHumans() }}</small>
                        <h5>{{ $ticket->client->name }}</h5>
                    </div>
                    <div> {!! str_replace("\n","<br>", $ticket->narration) !!}
                    </div>
                    <ul class="media-list">
                        @foreach($ticket->messages as $response)
                            @include('includes.message',['message' => $response])
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if($ticket->deleted_at==null)
        <div class="card">
            <div class="card-body">
                @include('includes.response',['route' => (auth()->user()->role == 'admin') ? route('support.resolution',["action" => "response","ticket" => $ticket]) : route('support.ticket',["action" => "response","ticket" => $ticket])])
            </div>
        </div>
    @endif
@endsection
