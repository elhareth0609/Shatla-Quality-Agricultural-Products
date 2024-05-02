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
        return $this->belongsToMany(Product::class, 'cart__products')->withPivot('quantity');
    }

    public function myCart($cid) {
      // Check if there exists a cart associated with this user
      return $this->products()->where('products.id', $cid)->exists();
    }
}
