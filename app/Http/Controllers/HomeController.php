<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index() {
      $subcategorys = SubCategory::all();
      $products = Product::all();
      return view('content.home.index')
      ->with('products',$products)
      ->with('subcategorys',$subcategorys);
    }

    public function contact() {
      return view('content.home.pages.contact');
    }
}
