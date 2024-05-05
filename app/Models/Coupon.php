<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
      'code',
      'discount',
      'max',
      'expired_date',
      'status'
    ];

    public function sells()
    {
        return $this->hasMany(Sell::class);
    }

    public function users()
    {
        return $this->hasMany(Coupon_Users::class);
    }
}
