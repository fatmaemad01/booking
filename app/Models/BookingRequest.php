<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'space_id' , 'start_date' ,'end_date' ,'start_time' ,'end_time' ,'status' ,'messgae'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function days()
    {
        return $this->belongsToMany(Day::class, 'booking_request_days', 'booking_request_id', 'day_id');
    }
}
