<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;


class SendWelcomeEmail
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
     * @param  \App\Events\NewUserRegistered  $event
     * @return void
     */
    public function handle(NewUserRegistered $event)
    {
        $user = $event->user;
        Mail::send('emails.welcome', ['user' => $user], function ($message) use ($user) {
            $message->from('hello@example.com', 'John Doe');
            $message->subject('Welcome aboard '.$user->name.'!');
            $message->to($user->email);
        });
    }
}
