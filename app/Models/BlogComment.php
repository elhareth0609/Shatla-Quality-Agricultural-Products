<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $fillable = [
      'profile_id',
      'blog_id',
      'content'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
