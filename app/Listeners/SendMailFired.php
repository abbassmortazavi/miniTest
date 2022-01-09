<?php

namespace App\Listeners;

use App\Events\SendMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        $user = User::find($event->userId)->toArray();
        Mail::send('mails.mailEvent', $user, function($message) use ($user) {
            $message->to($user['email']);
            $message->subject('Event Testing');
        });
    }
}
