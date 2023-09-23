<?php

namespace App\Rules;

use Closure;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidDays implements Rule
{
    public function passes($attribute, $value)
    {

        // dd(request('start_date'));
        // dd(request('end_date'));
        // dd(request('days'));
        $start = Carbon::parse(request('start_date'));
        $end = Carbon::parse(request('end_date'));

        // Get all the days within the specified date range
        $validDays = collect([]);

        while ($start <= $end) {
            $validDays->push($start->format('l'));
            $start->addDay();
        }

        // Check if all  days are within the validDays array
        $selectedDays = collect($value);

        return $selectedDays->diff($validDays)->isEmpty();
    }

    public function message()
    {
        return 'Day Name is not within the specified date range.';
    }
}
