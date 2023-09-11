<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Space extends Model
{
    use HasFactory;

    public static string $disk = 'public';

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

    public static function uploadImage($file)
    {
        $path = $file->store('/images', [
            'disk' =>  static::$disk,
        ]);
        return $path;
    }

    public static function deleteImage($path)
    {
        return Storage::disk(Space::$disk)->delete($path);
    }

    // public function users
}
