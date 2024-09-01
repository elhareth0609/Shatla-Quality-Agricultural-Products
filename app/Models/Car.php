<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;


    public function user() {
      return $this->belongsTo(User::class);
    }
    
    public function locations() {
        return $this->hasMany(Location::class);
    }
  
}
