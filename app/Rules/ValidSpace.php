<?php

namespace App\Rules;

use App\Space;
use App\Models\Availability;
use Illuminate\Contracts\Validation\Rule;

class ValidSpace implements Rule
{
    public function passes($attribute, $value)
    {
        $data = request()->all();

        $spaceId = $data['space_id'];
        $start_time = request('start_time');
        $end_time = request('end_time');

        $conflictingAvailabilities = Availability::where('space_id', $spaceId)
            ->where(function ($query) use ($start_time, $end_time) {
                $query->where(function ($query) use ($start_time, $end_time) {
                    $query->where('start_time', '<=', $start_time)
                        ->where('end_time', '>=', $end_time);
                });
            })
            ->exists();
            // dd($spaceId, $start_time, $end_time, $conflictingAvailabilities);


        // Check if any conflicting availabilities were found
        return $conflictingAvailabilities;
    }

    // public function passes($attribute, $value)
    // {
        // $data = request()->all();
        // $spaceId = $data['space_id'];
        // $start_time = request('start_time');
        // $end_time = request('end_time');

        // $availabilities = Availability::where('space_id', $spaceId)->get();
        // dd($availabilities);
        // // Iterate through each availability and check for conflicts
        // foreach ($availabilities as $availability) {
        //     if ($this->hasConflict($availability, $start_time, $end_time)) {
        //         return false; // Conflict found, validation fails
        //     }
        //     // $conflict = $this->hasConflict($availability, $start_time, $end_time);
        //     // // return $conflict;
        //     // dd($conflict);
        // }

        // return true; // No conflicts found, validation passes
    // }

    // public function passes($attribute, $value)
    // {

    //         // Access the space_id, start_time, and end_time from the request
    //         $spaceId = request('space_id');
    //         $start_time = request('start_time');
    //         $end_time = request('end_time');

    //         // Check availability using the AvailabilityService
    //         $currentDateTime = now();

    //         $availability = Availability::where('availabilities.space_id', $spaceId) // Specify the table alias
    //         ->where('availabilities.end_time', '>', $currentDateTime)
    //         ->leftJoin('booking_requests', function ($join) use ($spaceId, $currentDateTime) {
    //             $join->on('availabilities.space_id', '=', 'booking_requests.space_id')
    //                 ->where('booking_requests.status', 'accepted')
    //                 ->whereRaw("availabilities.start_time <= booking_requests.end_time AND availabilities.end_time >= booking_requests.start_time")
    //                 ->where('booking_requests.start_time', '<=', $currentDateTime)
    //                 ->where('booking_requests.end_time', '>=', $currentDateTime)
    //                 ->orWhere('booking_requests.status', 'pending')
    //                 ->where('booking_requests.space_id', $spaceId)
    //                 ->whereRaw("availabilities.start_time <= ? AND availabilities.end_time >= ?", [$currentDateTime, $currentDateTime]);
    //         })
    //         ->select('availabilities.*', 'booking_requests.id as booking_request_id')
    //         ->orderBy('availabilities.start_time')
    //         ->exists();


    //         dd($availability);
    //         // return $isAvailable;

    // }
    // private function hasConflict($availability, $start_time, $end_time)
    // {
    //     return ($availability->start_time <= $start_time && $availability->end_time >= $start_time
    //         || $availability->start_time <= $end_time && $availability->end_time >= $end_time
    //         || $start_time <= $availability->start_time && $end_time >= $availability->end_time
    //     );
    // }


    public function message()
    {
        return 'Space is not available at the requested time.';
    }
}
