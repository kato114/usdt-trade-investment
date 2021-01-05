<?php

namespace App\Http\Controllers;


use App\Attachment;
use App\File;
use App\Message;
use App\SupportTicket;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

trait RepliesTicket
{
    public function replyTicket()
    {
        $ticket = SupportTicket::query()->findOrFail(\request('ticket'));
        \request()->validate(['narration' => "required", "file" => "required_with:attachment"]);

        DB::beginTransaction();
        $message = new Message([
            "narration" => \request("narration"),
            "sender_type" => class_basename(auth()->user()),
            "sender_id" => auth()->id(),
            "conversation_type" => class_basename($ticket),
            "conversation_id" => auth()->id()
        ]);
        $ticket->messages()->save($message);
        $files = collect(\request('attachment'))->map(function ($value, $key) {
            $tmpName = tempnam("/tmp", "circle");
            $raw = explode(',', $value);
            file_put_contents($tmpName, base64_decode($raw[count($raw) - 1]));
            $file = new UploadedFile($tmpName, \request('file')[$key]);
            return $file;
        });
        foreach ($files as $file) {
            $attachment = Attachment::from(File::from($file, 'attachments'));
            $message->attachments()->save($attachment);
        }
        if (user()->role == 'admin') {
            $ticket->status = 'replied';
            \Mail::to($ticket->client)->send(new \App\Mail\SupportTicketResponse($message));
        } else {
            $ticket->status = 'pending';
            \Mail::to(User::get())->send(new \App\Mail\SupportTicketResponse($message));
        }
        $ticket->save();
        DB::commit();
        return back();
    }
}
