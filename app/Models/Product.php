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

  // category
  // seller
}
