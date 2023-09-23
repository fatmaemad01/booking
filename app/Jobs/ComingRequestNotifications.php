<?php

namespace App\Jobs;

use App\Models\BookingRequest;
use App\Notifications\SendNotificationForComingRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ComingRequestNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $requests = BookingRequest::whereDate('start_date' , '=' , now()->addDay())->cursor();

        foreach($requests as $request) {
            $request->user->notify(new SendNotificationForComingRequest($request));
        }
    }
}
