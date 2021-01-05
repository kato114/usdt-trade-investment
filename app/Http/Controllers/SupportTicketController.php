<?php

namespace App\Http\Controllers;

use App\SupportTicket;
use App\User;

class SupportTicketController extends Controller
{
    use RepliesTicket;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:client');
    }

    public function index($action = null)
    {
        switch ($action) {
            case 'listing':
                return $this->listing();
            case 'open':
                return $this->openTicket();
            case 'view':
                return $this->viewTicket();
            case 'response':
                return $this->replyTicket();
            default:
                return redirect(route('support.ticket', ['action' => 'listing']));
        }
    }

    public function listing()
    {
        return view('support.listing');
    }

    public function viewTicket()
    {
        $ticket = SupportTicket::query()->withTrashed()->findOrFail(\request('ticket'));
        return view('support.view', compact('ticket'));
    }

    public function openTicket()
    {
        if (\request()->isMethod('post')) {
            \request()->validate([
                'subject' => 'required',
                'narration' => 'required',
            ]);
            $ticket = new SupportTicket(\request()->only('subject', 'narration'));
            auth()->user()->tickets()->save($ticket);
            \Mail::to(User::get())->send(new \App\Mail\SupportTicket($ticket));
            return redirect(route('support.ticket'))->withSuccess("Ticket Opened");
        } else {
            return view('support.open');
        }
    }
}
