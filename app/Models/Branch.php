<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id' , 'name' , 'work_days' , 'location'
    ];

    public function spaces()
    {
        return $this->hasMany(Space::class);
    }
}
