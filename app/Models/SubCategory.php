<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
      'category_id',
      'name_ar',
      'name_fr',
      'name_en',
      'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class,'subcategory_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'subcategory_id');
    }

    public function photoUrl() {
      $photo = $this->photo;

      if (Str::startsWith($photo, 'http')) {
          return $photo;
      } else {
          return asset('assets/img/photos/subcategorys/' . $photo);
      }
  }

  public function photoPath() {
    $photo = $this->photo;

    if (!empty($photo)) {
        return public_path('assets/img/photos/subcategorys/' . $photo);
    } else {
        // Return default path or handle empty photo case as needed
        return public_path('assets/img/photos/subcategorys/default.jpg');
    }
  }

    public function getName() {
      $locale = app()->getLocale();

      if ($locale === 'ar') {
          return $this->name_ar;
      } elseif ($locale === 'en') {
          return $this->name_en;
      } elseif ($locale === 'fr') {
          return $this->name_fr;
      } else {
          return $this->name_en;
      }
    }
  }
