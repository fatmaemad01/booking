<?php

namespace App\Listeners;

use App\Models\BookingRequest;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\RequestResponseNotification;

class SendNotificationToMember
{
    /**
     * Create the event listener.
     */
    public function __construct(public BookingRequest $bookingRequest)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $member = $event->bookingRequest->user()->where('role' , 'member')->get();

        foreach ($member as $member) {
            $member->notify(new RequestResponseNotification($event->bookingRequest));
        }

        
    }
}
