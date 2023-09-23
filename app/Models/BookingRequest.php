<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Notifications\Notifiable;

class BookingRequest extends Model
{
    use HasFactory , Notifiable , Prunable;

    protected $fillable = [
        'user_id', 'space_id', 'start_date', 'end_date', 'start_time', 'end_time', 'days' , 'status', 'message'
    ];

    protected $casts = [
        // 'start_date' => 'date',
        // 'end_date' => 'date',
        'days' => 'array',
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
        return $this->belongsToMany(Day::class, 'booking_request_days', 'day_id');
    }
    public function requests()
    {
        return $this->hasMany(BookingRequestDay::class, 'booking_request_id');
    }
    public function prunable()
    {
        return static::where('end_date' , '<=' , now()->subDay());
    }

}
