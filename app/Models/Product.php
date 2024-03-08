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

  public function getNewPrice($currency)
{
    $price = $this->price;

    // if ($currency === config('currency.default_currency')) {
    //   return $price;
    // }

    $baseCurrency = 'DZD';

    $response = $this->client->get("https://open.er-api.com/v6/latest/{$baseCurrency}");
    $data = json_decode($response->getBody(), true);

    $exchangeRate = $data['rates'][$currency];

    $newPrice = $exchangeRate * $price;

    return $newPrice;
}

}
