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
         $photo = $this->photo;

        if (Str::startsWith($photo, 'http')) {
            return $photo;
        } else {
            return asset('assets/img/photos/users/' . $photo);
        }
    }

    public function photoPath() {
      $photo = $this->photo;

      if (!empty($photo)) {
          return public_path('assets/img/photos/users/' . $photo);
      } else {
          return null;
      }
    }

    public function adress()
    {
        return $this->hasMany(Adress::class);
    }

    public function blogs() {
        return $this->hasMany(Blog::class);
    }

    public function publications() {
      return $this->hasMany(Publication::class);
    }

    public function cart() {
        return $this->hasOne(Cart::class);
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function myFavorite($pid) {
      return $this->favorites()->where('product_id', $pid)->exists();
    }

    public function orders() {
        return $this->hasMany(Sell::class);
    }

    public function profiles() {
        return $this->hasMany(Profile::class);
    }

    public function farmer() {
        return $this->hasOne(Profile::class)->where('plan_id', 0);
    }


    public function worker() {
      return $this->hasOne(Profile::class)->where('plan_id', 1);
    }

    public function expert() {
        return $this->hasOne(Profile::class)->where('plan_id', 2);
    }

    public function marchent() {
      return $this->hasOne(Profile::class)->where('plan_id', 3);
    }

    public function profile() {
        return $this->hasOne(Profile::class)->where('active', '1');
    }

    public function isCan($permission) {
      return $this->profile->plan->permissions->contains('name',$permission);
    }
}
