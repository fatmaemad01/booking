<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NotifyNewUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendUserLoginDetails
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $users = User::where('email', request('email'))->get();

        Notification::send($users, new NotifyNewUser($event->user));
    }
}
