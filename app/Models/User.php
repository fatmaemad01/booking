<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public static string $disk = 'public';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'role',
        'personal_image',
        'locale',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function admin()
    {
        $admin = $this->where('role' , 'admin')->get();
        return $admin;
    }

    public function member()
    {
        $member = $this->where('role' , 'member')->get();
        return $member;
    }

    public static function uploadImage($file)
    {
        $filename = $file->getClientOriginalName();
        $path = $file->storeAs('/userimages', $filename , [
            'disk' =>  static::$disk,
        ]);
        return $path;
    }

    public static function deleteImage($path)
    {
        return Storage::disk(User::$disk)->delete($path);
    }
    
    public function books()
    {
        return $this->hasMany(BookingRequest::class);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

}
