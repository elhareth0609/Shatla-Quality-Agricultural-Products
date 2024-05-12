<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PublicationPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
      'publication_id',
      'image'
    ];

    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }

    public function photoUrl() {
      $image = $this->image;

      if (Str::startsWith($image, 'http')) {
          return $image;
      } else {
          return asset('assets/img/photos/publications/' . $image);
      }
  }

  public function photoPath() {
    $image = $this->image;

    if (!empty($image)) {
        return public_path('assets/img/photos/publications/' . $image);
    } else {
        // Return default path or handle empty photo case as needed
        return public_path('assets/img/photos/publications/default.jpg');
    }
  }

}
