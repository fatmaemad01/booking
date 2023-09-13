<?php

namespace App\Listeners;

use App\Events\CreateSpace;
use App\Models\Availability;
use Illuminate\Support\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateAvailability
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
    public function handle($event): void
    {
        $space = $event->space;
        $booking_request = $event->bookingRequest;

        if ($space) {

            Availability::create([
                'space_id' => $space->id,
                'start_date' => now()->format('Y-m-d'),
                'start_time' => request('available_from') ?? Carbon::parse('8:00 AM')->format('H:i:s'),
                'end_time' => request('available_to') ?? Carbon::parse('5:00 PM')->format('H:i:s'),
            ]);
        } elseif ($booking_request) {
            Availability::create([
                'space_id' => $booking_request->space_id,
                'start_date' => $booking_request->start_date,
                'end_date' => $booking_request->end_date,
                'start_time' => $booking_request->start_time,
                'end_time' => $booking_request->end_time,
                'available' => false
            ]);
        }
        dd($booking_request);
    }
}
