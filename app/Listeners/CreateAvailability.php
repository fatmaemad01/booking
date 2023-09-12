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
    public function handle(CreateSpace $event): void
    {
        $space = $event->space;

        Availability::create([
            'space_id' => $space->id,
            'start_date' => now()->format('Y-m-d'),
            'start_time' => Carbon::parse('8:00 AM')->format('H:i:s'),
            'end_time' => Carbon::parse('5:00 PM')->format('H:i:s'),
        ]);
    }
}
