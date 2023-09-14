<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'location' , 'start_time' ,'end_time'
     ];
 
     public function spaces()
     {
         return $this->hasMany(Space::class);
     }
 
     public function workDays()
     {
        return $this->belongsToMany(Day::class , 'branch_days');
     }
}
