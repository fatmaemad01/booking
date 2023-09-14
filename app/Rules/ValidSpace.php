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

        // Check if any conflicting availabilities were found
        return $conflictingAvailabilities;
    }
    public function message()
    {
        return 'The selected time slot is not available.';
    }
}
