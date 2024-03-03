<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fileable = [
      'name',
      'description',
      'price',
      'features'
    ];

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
}
