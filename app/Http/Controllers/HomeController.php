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
      $productsCount = Product::where('status','active')->count();
      $products = Product::where('status','active')->orderBy('created_at', 'desc')->take(12)->get();
      $blogsCount = Blog::where('status','published')->count();
      $blogs = Blog::where('status','published')->orderBy('created_at', 'desc')->take(6)->get();
      $publicationsCount = Publication::where('status','published')->count();
      $publications = Publication::where('status','published')->orderBy('created_at', 'desc')->take(6)->get();
      return view('content.home.index')
      ->with('products',$products)
      ->with('productsCount',$productsCount)
      ->with('subcategorys',$subcategorys)
      ->with('blogs',$blogs)
      ->with('blogsCount',$blogsCount)
      ->with('publications',$publications)
      ->with('publicationsCount',$publicationsCount);
    }

    public function contact() {
      return view('content.home.pages.contact');
    }
}
