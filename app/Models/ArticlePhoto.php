<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ArticlePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
      'article_id',
      'image'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function photoUrl() {
      $image = $this->image;

      if (Str::startsWith($image, 'http')) {
          return $image;
      } else {
          return asset('assets/img/photos/articles/' . $image);
      }
  }

  public function photoPath() {
    $image = $this->image;

    if (!empty($image)) {
        return public_path('assets/img/photos/articles/' . $image);
    } else {
        return public_path('assets/img/photos/articles/default.jpg');
    }
  }

}
