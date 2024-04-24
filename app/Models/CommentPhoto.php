<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CommentPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'product_id',
      'content',
      'stars'
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function photoUrl() {
        $photo = $this->photo;

        if (Str::startsWith($photo, 'http')) {
            return $photo;
        } else {
            return asset('assets/img/photos/commments/' . $photo);
        }
    }

    public function photoPath() {
      $photo = $this->photo;

      if (!empty($photo)) {
          return public_path('assets/img/photos/commments/' . $photo);
      } else {
          // Return default path or handle empty photo case as needed
          return public_path('assets/img/photos/commments/default.jpg');
      }
    }
}
