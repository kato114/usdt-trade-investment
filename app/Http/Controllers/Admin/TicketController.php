<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RepliesTicket;
use App\SupportTicket;

class TicketController extends Controller
{
    use RepliesTicket;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index($action = null)
    {
        switch ($action) {
            case 'listing':
                return $this->listing();
            case 'view':
                return $this->viewTicket();
            case 'close':
                return $this->closeTicket();
            case 'response':
                return $this->replyTicket();
            default:
                return redirect(route('support.resolution', ['action' => 'listing']));
        }
    }

    public function listing()
    {
        $tickets = SupportTicket::query();
        if (request('trashed')) {
            $tickets->onlyTrashed();
        }
        $tickets = $tickets->paginate(12);
        return view('admin.ticket.listing', compact('tickets'));
    }

    public function viewTicket()
    {
        $ticket = SupportTicket::query()->withTrashed()->findOrFail(\request('ticket'));
        return view('admin.ticket.view', compact('ticket'));
    }

    public function closeTicket()
    {
        $ticket = SupportTicket::query()->findOrFail(\request('ticket'));
        $ticket->delete();
        return redirect(route('support.resolution'));
    }
}
