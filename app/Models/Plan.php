<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plan extends Model
{
    use HasFactory;

    protected $fileable = [
      'name',
      'description',
      'price',
      'features',
      'image'
    ];

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    public function photoUrl() {
        $photo = $this->image;

      if (Str::startsWith($photo, 'http')) {
          return $photo;
      } else {
          return asset('assets/img/photos/plans/' . $photo);
      }
    }

    public function photoPath() {
      $photo = $this->image;

      if (!empty($photo)) {
          return public_path('assets/img/photos/plans/' . $photo);
      } else {
          // Return default path or handle empty photo case as needed
          return public_path('assets/img/plans/default.jpg');
      }
    }
}
