<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use App\Models\Profile;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
  public function view($id) {
    $expert = Profile::find($id);
    $blogs = Blog::where('user_id', $expert->user->id)->get();
    return view('content.home.experts.index')
    ->with('expert',$expert)
    ->with('blogs',$blogs);
    ;
  }

  public function all() {
    $experts = Profile::where('plan_id', 2)->get();
    return view('content.home.experts.all')
    ->with('experts', $experts);
  }
}
