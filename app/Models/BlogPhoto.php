<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
      'blog_id',
      'image'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function photoUrl() {
      $image = $this->image;

      if (Str::startsWith($image, 'http')) {
          return $image;
      } else {
          return asset('assets/img/photos/blogs/' . $image);
      }
  }

  public function photoPath() {
    $image = $this->image;

    if (!empty($image)) {
        return public_path('assets/img/photos/blogs/' . $image);
    } else {
        // Return default path or handle empty photo case as needed
        return public_path('assets/img/photos/blogs/default.jpg');
    }
  }

}
