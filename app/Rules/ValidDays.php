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

        $start = Carbon::parse(request('start_date'));
        $end = Carbon::parse(request('end_date'));

        $validDays = collect([]);

        while ($start <= $end) {
            $validDays->push($start->format('l'));
            $start->addDay();
        }

        $selectedDays = collect($value);

        return $selectedDays->diff($validDays)->isEmpty();
    }

    public function message()
    {
        return 'Day Name is not within the specified date range.';
    }
}
