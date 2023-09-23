<?php

namespace App\Rules;

use Carbon\Carbon;
use App\Models\BookingRequest;
use App\Models\BookingRequestDay;
use Illuminate\Contracts\Validation\Rule;

class CheckRequestConflicts implements Rule
{

    public function passes($attribute, $value)
    {
        $startDate = Carbon::parse(request('start_date'));
        $endDate = Carbon::parse(request('end_date'));
        $days = request('days');
        $startTime = request('start_time');
        $endTime = request('end_time');
        $dates = [];

        // Iterate through each date in the range
        while ($startDate->lte($endDate)) {
            // Check if the current day name is in the desired list
            if (in_array($startDate->englishDayOfWeek, $days)) {
                $dates[] = $startDate->toDateString();
            }
            $startDate->addDay();
        }

        foreach ($dates as $date) {
            $conflict = BookingRequestDay::where('space_id', request('space_id'))
                ->where('booking_date', $date)
                ->where('status', 'accepted')
                ->where('start_time', '<=', $endTime)
                ->where('end_time', '>=', $startTime)
                ->exists();
            if ($conflict == true) {
                return false;
            }
        }
        return true;
    }

    public function message()
    {
        return 'There are conflicts with another booking requests for the selected time slot.';
    }
}
