<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cart_Products;
use App\Models\Product;
use App\Models\Publication;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index() {
      $subcategorys = SubCategory::where('type','products')->get();
      $products = Product::all();
      $blogs = Blog::orderBy('created_at', 'desc')->take(6)->get();
      $publications = Publication::orderBy('created_at', 'desc')->take(6)->get();
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
