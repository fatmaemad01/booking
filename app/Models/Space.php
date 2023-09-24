<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Space extends Model
{
    use HasFactory;

    public static string $disk = 'public';

    protected $fillable = [
        'branch_id', 'type', 'name', 'capacity', 'price', 'availablity', 'assets' , 'image', 'start_time' , 'end_time'
    ];

    protected $casts = [
        'availablity' => 'array',
    ];

    // Relations

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function bookingRequests()
    {
        return $this->hasMany(BookingRequest::class);
    }


    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }


    // Image Upload
    public static function uploadImage($file)
    {
        $path = $file->store('/spaces', [
            'disk' =>  static::$disk,
        ]);
        return $path;
    }

    public static function deleteImage($path)
    {
        return Storage::disk(Space::$disk)->delete($path);
    }

    // Accessors

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['search'] ?? '', function ($builder, $value) {
            $builder->where('name', 'LIKE', "%{$value}%");
    });
    }

}
