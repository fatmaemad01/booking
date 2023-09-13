<?php

namespace App\Listeners;

use App\Models\Availability;
use App\Events\AcceptedRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewSpaceAvailability
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
    public function handle(AcceptedRequest $event): void
    {
        $bookingRequest = $event->bookingRequest;
        dd('tst');
        Availability::create([
            'space_id' => $bookingRequest->space_id,
            'start_date' => $bookingRequest->start_date,
            'end_date' => $bookingRequest->end_date,
            'start_time' => $bookingRequest->start_time,
            'end_time' => $bookingRequest->end_time,
            'available' => false
        ]);
    }
}
