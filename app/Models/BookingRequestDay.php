<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRequestDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'booking_request_id', 'space_id', 'status', 'booking_date', 'start_time' , 'end_time'
    ];


    public function request()
    {
        return $this->belongsTo(BookingRequest::class, 'booking_request_id');
    }
}
