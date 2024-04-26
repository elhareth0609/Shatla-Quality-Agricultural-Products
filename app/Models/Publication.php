<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Publication extends Model {
    use HasFactory;

    protected $fillable = [
      'name',
      'image',
      'content'
    ];

    public function subcategory() {
      return $this->belongsTo(SubCategory::class);
    }

    public function photoUrl() {
      $photo = $this->image;

      if (Str::startsWith($photo, 'http')) {
          return $photo;
      } else {
          return asset('assets/img/publications/blogs/' . $photo);
      }
    }

    public function photoPath() {
      $photo = $this->image;

      if (!empty($photo)) {
          return public_path('assets/img/photos/publications/' . $photo);
      } else {
          // Return default path or handle empty photo case as needed
          return public_path('assets/img/publications/default.jpg');
      }
    }
}
