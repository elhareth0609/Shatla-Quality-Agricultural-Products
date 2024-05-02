<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use App\Models\Publication;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index() {
      $subcategorys = SubCategory::where('type','products')->get();
      $products = Product::all();
      $blogs = Blog::orderBy('created_at', 'desc')->take(8)->get();
      $publications = Publication::all();
      return view('content.home.index')
      ->with('products',$products)
      ->with('subcategorys',$subcategorys)
      ->with('blogs',$blogs)
      ->with('publications',$publications);
    }

    public function contact() {
      return view('content.home.pages.contact');
    }
}
