<?php

namespace App\Rules;

use Closure;
use Carbon\Carbon;
use App\Models\BookingRequestDay;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class OneUserRequest implements Rule
{
    public function passes($attribute, $value)
    {
        $startDate = Carbon::parse(request('start_date'));
        $endDate = Carbon::parse(request('end_date'));
        $days = request('days');
        $dates = [];

        while ($startDate->lte($endDate)) {
            if (in_array($startDate->englishDayOfWeek, $days)) {
                $dates[] = $startDate->toDateString();
            }
            $startDate->addDay();
        }
        foreach ($dates as $date) {
            $userConflict = BookingRequestDay::where('user_id', Auth::id())
                ->where('booking_date', $date)
                ->where('status', 'accepted')
                ->exists();

            if ($userConflict == true) {
               return false;
            }
        }
        return true;
    }

    public function message()
    {
        return 'Only one request allowed at same date.';
    }
}
