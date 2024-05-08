<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\Product;

class MarchentController extends Controller
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
