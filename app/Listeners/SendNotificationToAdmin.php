<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\RequestCreated;
use App\Models\BookingRequest;
use App\Notifications\RequestCreatedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationToAdmin
{
    /**
     * Create the event listener.
     */
    public function __construct(public BookingRequest $bookingRequest)
    {
        
    }

    /**
     * Handle the event.
     */
    public function handle(RequestCreated $event): void
    {
        $admins = User::where('role' , 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(new RequestCreatedNotification($event->bookingRequest));
        }
        
    }
}
