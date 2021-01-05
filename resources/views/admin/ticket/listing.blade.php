@extends('layouts.main')
@section('title')
    Support Center
    @if(request('trashed') != 'true')
        <a data-turbolinks="false" href="{{route('support.resolution', ['action' => 'listing','trashed' => "true"])}}"
           class="btn btn-outline-primary float-right">Closed Tickets</a>
    @else
        <a data-turbolinks="false" href="{{route('support.resolution', ['action' => 'listing'])}}"
           class="btn btn-outline-primary float-right">Open Tickets</a>
    @endif
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> @if(request('trashed') != 'true') Open Tickets @else Closed Tickets @endif</h3>
            <div class="card-options">
            </div>
        </div>
        @if($tickets->count() >0)
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>Subject</th>
                        <th>Client</th>
                        <th>Last Updated</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td><span class="text-muted">{{ $ticket->id }}</span></td>
                            <td class="wrap">
                                <a href="{{ route('support.resolution',['action'=>'view','ticket' => $ticket]) }}">{{ $ticket->subject }}</a>
                            </td>
                            <td>
                                <a href="{{ route("client",['client' => $ticket->client]) }}">{{ $ticket->client->name }}</a>
                            </td>
                            <td>
                                {{ $ticket->updated_at->format('jS M Y') }}
                            </td>
                            <td>
                                <span
                                    class="status-icon @if($ticket->status == 'pending') bg-success @else bg-secondary @endif"></span> {{  ucfirst( $ticket->status) }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty text-center">
                <div class="empty-icon mt-5" style="font-size: 32px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                        <line x1="9" y1="9" x2="9.01" y2="9"></line>
                        <line x1="15" y1="9" x2="15.01" y2="9"></line>
                    </svg>
                </div>
                <p class="empty-title h3">None as yet.</p>
            </div>
        @endif
    </div>
@endsection
