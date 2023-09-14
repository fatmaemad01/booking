<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchDay extends Model
{
    use HasFactory;

    protected $table = 'branch_days';

    protected $fillable = ['branch_id', 'day_id', 'start_time', 'end_time'];

}
