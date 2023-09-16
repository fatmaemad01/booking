<?php

namespace App\Listeners;

use App\Events\UpdateSpace;
use App\Models\Availability;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateAvailabilty
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
    public function handle(UpdateSpace $event): void
    {
        $space = $event->space;

        $availabilty = Availability::where('space_id', $space->id)->first();
        $availabilty->update([
            'start_time' => request('available_from') ,
            'end_time' => request('available_to'),
        ]);
    }
}
