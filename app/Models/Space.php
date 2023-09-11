<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id', 'type', 'name', 'capacity', 'price', 'availablity', 'assets' , 'image'
    ];

    protected $casts = [
        'availablity' => 'array',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
