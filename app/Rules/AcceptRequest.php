<?php

namespace App\Rules;

use Closure;
use App\Models\BookingRequest;
use App\Models\BookingRequestDay;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class AcceptRequest implements Rule
{
    protected $bookingRequest;

    public function __construct(BookingRequest $bookingRequest)
    {
        $this->bookingRequest = $bookingRequest;
    }

    public function passes($attribute, $value)
    {
        $conflictingBooking = BookingRequestDay::where('space_id', $this->bookingRequest->space_id)
            ->where('status', 'accepted')
            ->where(function ($query) {
                $query->whereBetween('start_date', [$this->bookingRequest->start_date, $this->bookingRequest->end_date])
                    ->orWhereBetween('end_date', [$this->bookingRequest->start_date, $this->bookingRequest->end_date]);
            })
            ->where(function ($query) {
                $query->whereTime('start_time', '<', $this->bookingRequest->end_time)
                    ->whereTime('end_time', '>', $this->bookingRequest->start_time);
            })
            ->first();

        return !$conflictingBooking;
    }

    public function message()
    {
        return 'Booking conflicts with an existing accepted booking.';
    }
}
