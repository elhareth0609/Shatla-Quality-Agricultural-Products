<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\Product;

class MarchentController extends Controller
{
  public function view($id) {
    $marchent = Profile::find($id);
    $products = Product::where('seller_id', $marchent->user->id)->get();
    return view('content.home.sellers.index')
    ->with('seller',$marchent)
    ->with('products',$products);
    ;
  }

  public function all() {
    $experts = Profile::where('plan_id', 3)->get();
    return view('content.home.sellers.all')
    ->with('experts', $experts);
  }
}
