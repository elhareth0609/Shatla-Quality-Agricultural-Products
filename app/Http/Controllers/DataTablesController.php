<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sell;
use DataTables;

class DataTablesController extends Controller
{
    public function users(Request $request) {

      $users = User::where('role', 'user')->get();

      if($request->ajax()) {
        return DataTables::of($users)
        ->editColumn('id', function ($user) {
            return $user->id;
        })
        ->editColumn('email', function ($user) {
          return $user->price;
        })
        ->editColumn('fullname', function ($user) {
          return $user->fullname;
        })
        ->editColumn('phone', function ($user) {
          return $user->status;
        })
        ->editColumn('photo', function ($user) {
          return $user->photo;
        })
        ->editColumn('created_at', function ($user) {
          return $user->created_at->format('Y-m-d');
        })
        ->addColumn('action', function ($user) {
            return '<button class="btn btn-primary">Edit</button>';
        })
        ->rawColumns(['action'])
        ->make(true);
      }

      return view('content.dashboard.users.list');
    }

    public function categorys(Request $request) {

    }

    public function products(Request $request) {
      $products = Product::all();
      if ($request->ajax()) {
        return DataTables::of($products)
        ->editColumn('id', function ($product) {
          return $product->id;
        })
        ->editColumn('price', function ($product) {
          return $product->price;
        })
        ->editColumn('category_id', function ($product) {
          return $product->category->name;
        })
        ->editColumn('status', function ($product) {
          return $product->status;
        })
        ->editColumn('image', function ($product) {
          return $product->image;
        })
        ->editColumn('name', function ($product) {
          return $product->name;
        })
        ->editColumn('created_at', function ($product) {
          return $product->created_at->format('Y-m-d H:i:s');
        })
        ->addColumn('action', function ($product) {
            return '<button class="btn btn-primary">Edit</button>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    return view('content.dashboard.products.list');
    }

    public function experts(Request $request) {
      $experts = User::where('role', 'expert')->get();

      if($request->ajax()) {
        return DataTables::of($experts)
        ->editColumn('id', function ($expert) {
            return $expert->id;
        })
        ->editColumn('email', function ($expert) {
          return $expert->price;
        })
        ->editColumn('fullname', function ($expert) {
          return $expert->fullname;
        })
        ->editColumn('phone', function ($expert) {
          return $expert->status;
        })
        ->editColumn('photo', function ($expert) {
          return $expert->photo;
        })
        ->editColumn('created_at', function ($expert) {
          return $expert->created_at->format('Y-m-d');
        })
        ->addColumn('action', function ($expert) {
            return '<button class="btn btn-primary">Edit</button>';
        })
        ->rawColumns(['action'])
        ->make(true);
      }

      return view('content.dashboard.experts.list');

    }

    public function sellers(Request $request) {
      $sellers = User::where('role', 'seller')->get();

      if($request->ajax()) {
        return DataTables::of($sellers)
        ->editColumn('id', function ($seller) {
            return $seller->id;
        })
        ->editColumn('email', function ($seller) {
          return $seller->price;
        })
        ->editColumn('fullname', function ($seller) {
          return $seller->fullname;
        })
        ->editColumn('phone', function ($seller) {
          return $seller->status;
        })
        ->editColumn('photo', function ($seller) {
          return $seller->photo;
        })
        ->editColumn('created_at', function ($seller) {
          return $seller->created_at->format('Y-m-d');
        })
        ->addColumn('action', function ($seller) {
            return '<button class="btn btn-primary">Edit</button>';
        })
        ->rawColumns(['action'])
        ->make(true);
      }

      return view('content.dashboard.sellers.list');

    }

    public function sales(Request $request) {

    }

    public function blogs(Request $request) {

    }
}
