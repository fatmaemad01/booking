<?php

namespace App\Rules;

use App\Models\Branch;
use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidBranch implements Rule
{

    public function passes($attribute, $value)
    {
        $branchId = request('branch_id');
        $start_time = request('available_from');
        $end_time = request('available_to');

        $conflicting = Branch::where('id', $branchId)
            ->where(function ($query) use ($start_time, $end_time) {
                $query->where(function ($query) use ($start_time, $end_time) {
                    $query->where('start_time', '<=', $start_time)
                        ->where('end_time', '>=', $end_time);
                });
            })
            ->exists();
        // Check if any conflicting availabilities were found
        return $conflicting;
    }

    public function message()
    {
        return 'The Branch is not available at this time.';
    }
}
