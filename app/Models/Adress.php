<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'first_name',
      'last_name',
      'phone1',
      'phone2',
      'zip',
      'country',
      'state',
      'adress1',
      'adress2',
      'city'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
