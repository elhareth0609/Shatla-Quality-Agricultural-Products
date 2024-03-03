<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

  protected $fillable = [
    'name',
    'category_id',
    'price',
    'amount_price',
    'content',
    'status',
    'image'
  ];

  public function category()
  {
      return $this->belongsTo(Category::class);
  }

  public function carts()
  {
      return $this->belongsToMany(Cart::class, 'cart__products')->withPivot('price');
  }

  public function sells()
  {
      return $this->belongsToMany(Sell::class, 'sell__products')->withPivot('price');
  }

  public function favorites()
  {
      return $this->hasMany(Favorite::class);
  }

}
