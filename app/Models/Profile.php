<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'plan_id',
      'fullname',
      'email',
      'phone',
      'photo',
      'active'
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

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function plan()
  {
      return $this->belongsTo(Plan::class);
  }

  public function permissions()
  {
    return $this->belongsToMany(Permission::class);
  }
}
