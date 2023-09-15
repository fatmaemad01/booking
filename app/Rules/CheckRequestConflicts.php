<?php

namespace App\Rules;

use App\Models\BookingRequest;
use Illuminate\Contracts\Validation\Rule;

class CheckRequestConflicts implements Rule
{

    public function passes($attribute, $value)
    {
        $value = request()->all();
$spaceId = request('space_id');
         // Accepted Reques At Same Date
        $acceptedRequests = BookingRequest::where('space_id', $spaceId)
            ->where('status', 'accepted')
            ->get();

        // Check for conflicts with each accepted booking request
        foreach ($acceptedRequests as $request) {
            $conflicts = $request->where('space_id', $value['space_id'])
                ->where('status', 'accepted')
                ->where(function ($query) use ($value) {
                    $query->where(function ($query) use ($value) {
                        $query
                            ->where('start_date', '<=', $value['end_date'])
                            ->where('end_date', '>=', $value['start_date'])
                            ->where('start_time', '<=', $value['end_time'])
                            ->where('end_time', '>=', $value['start_time']);
                    });
                })->first();

                // dd($conflicts);
                if($conflicts){
                    return false;   // Found conflicts
                }
        }

        return true; // No conflicts
    }

    public function message()
    {
        return 'There are conflicts with another booking requests for the selected time slot.';
    }

}
