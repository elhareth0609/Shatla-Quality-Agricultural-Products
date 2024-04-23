<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
      'name'
    ];


    public function subCategorys()
    {
        return $this->hasMany(SubCategory::class);
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
