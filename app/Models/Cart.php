<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function products()
    {
      return $this->hasMany(Cart_Products::class);
    }

    public function myCart($cid) {
      return $this->products()->where('product_id', $cid)->exists();
    }

    public function totalCart() {
    $cart = $this->products;

    // if ($cart) {
        return $cart->sum(function ($cartProduct) {
            return $cartProduct->quantity * $cartProduct->product->price;
        });
    // }

    return 0;
    }
}
