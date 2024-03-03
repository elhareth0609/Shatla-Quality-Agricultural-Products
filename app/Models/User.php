<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'photo',
        'role',
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

    public function photoUrl() {
        return $photo = $this->photo;

        if (Str::startsWith($photo, 'http')) {
            return $photo;
        } else {
            return asset('assets/img/avatars/' . $photo);
        }
    }

    public function photoPath() {
      $photo = $this->photo;

      if (!empty($photo)) {
          return public_path('assets/img/users/' . $photo);
      } else {
          // Return default path or handle empty photo case as needed
          return public_path('assets/img/users/default.jpg');
      }
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function sells()
    {
        return $this->hasMany(Sell::class);
    }

}
