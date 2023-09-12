<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'space_id' , 'start_date', 'end_date' , 'start_time', 'end_time' , 'available'
    ];

    public function room()
    {
        return $this->belongsTo(Space::class);
    }
}
