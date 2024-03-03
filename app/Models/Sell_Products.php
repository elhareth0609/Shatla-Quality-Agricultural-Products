<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell_Products extends Model
{
    use HasFactory;

    protected $fillable = [
      'sell_id',
      'product_id',
      'price'
    ];


    public function sell()
    {
        return $this->belongsTo(Sell::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
