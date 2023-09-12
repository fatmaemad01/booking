<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_days');
    }

    public function bookingRequests()
    {
        return $this->belongsToMany(BookingRequest::class, 'booking_request_days', 'day_id', 'booking_request_id');
    }
}
