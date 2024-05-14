<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'disease_id',
      'type_id',
      'content',
      'image'
    ];

    public function photos() {
      return $this->hasMany(ArticlePhoto::class);
    }

    public function type() {
      return $this->belongsTo(Type::class);
    }

    public function disease() {
      return $this->belongsTo(Disease::class);
    }

    // public function user() {
    //   return $this->belongsTo(User::class);
    // }

    // public function comments() {
    //   return $this->hasMany(BlogComment::class);
    // }

    public function photoUrl() {
      $photo = $this->image;

      if (Str::startsWith($photo, 'http')) {
          return $photo;
      } else {
          return asset('assets/img/photos/articles/' . $photo);
      }
    }

    public function photoPath() {
      $photo = $this->image;

      if (!empty($photo)) {
          return public_path('assets/img/photos/articles/' . $photo);
      } else {
          // Return default path or handle empty photo case as needed
          return public_path('assets/img/articles/default.jpg');
      }
    }

    public static function TagsToString($tags) {
      if ($tags === null) {
        return '';
      }
        $tagValues = array_map(function($tag) {
            return $tag['value'];
        }, $tags);

        return implode(',', $tagValues);
    }

    public static function StringToTags($tagsString) {
        if (empty($tagsString)) {
            return [];
        }

        $tagValues = explode(',', $tagsString);

        $tags = array_map(function($tagValue) {
            return ['value' => $tagValue];
        }, $tagValues);

        return $tags;
    }


}
