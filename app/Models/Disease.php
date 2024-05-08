<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = [
      'name_en',
      'name_ar',
      'name_fr',
      'image',
      'status'
    ];

    public function photoUrl() {
      $image = $this->image;

      if (Str::startsWith($image, 'http')) {
          return $image;
      } else {
          return asset('assets/img/photos/diseases/' . $image);
      }
  }

  public function photoPath() {
    $image = $this->image;

    if (!empty($photo)) {
        return public_path('assets/img/photos/diseases/' . $image);
    } else {
        // Return default path or handle empty photo case as needed
        return public_path('assets/img/photos/diseases/default.jpg');
    }
  }
}
