<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
      'photo'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function photoUrl() {
      $photo = $this->photo;

      if (Str::startsWith($photo, 'http')) {
          return $photo;
      } else {
          return asset('assets/img/photos/products/' . $photo);
      }
  }

  public function photoPath() {
    $photo = $this->photo;

    if (!empty($photo)) {
        return public_path('assets/img/photos/products/' . $photo);
    } else {
        // Return default path or handle empty photo case as needed
        return public_path('assets/img/photos/products/default.jpg');
    }
  }
}
