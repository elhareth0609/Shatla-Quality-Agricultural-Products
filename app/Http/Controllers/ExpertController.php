<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Profile;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
  public function view($id) {
    $marchent = Profile::find($id);
    $products = Product::where('seller', $marchent->user->id)->get();
    return view('content.home.marchents.index')
    ->with('marchent',$marchent)
    ->with('products',$products);
    ;
  }
}
