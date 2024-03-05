<?php

namespace App\Http\Controllers;

use App\Models\Blog;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Sell;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
          return $user->email;
        })
        // ->editColumn('fullname', function ($user) {
        //   return $user->fullname;
        // })
        ->editColumn('photo', function ($user) {
            return '
            <div class="d-flex align-items-center">
              <div class="avatar avatar-sm me-3">
                <img src="' . $user->photoUrl() . '" alt="' . $user->fullname . '" class="rounded-circle">
              </div>
              <div class="' . (app()->isLocale('ar') ? 'text-end' : 'text-start') . '">
              <h6 class="mb-0 text-truncate">' . $user->fullname . '</h6>
                <small class="text-truncate">' . $user->phone . '</small>
              </div>
            </div>
            ';

        })
        // ->editColumn('phone', function ($user) {
        //   return $user->phone;
        // })
        ->editColumn('created_at', function ($user) {
          return $user->created_at->format('Y-m-d');
        })
        ->addColumn('action', function ($user) {
            return '<button class="btn btn-primary">Edit</button>';
        })
        ->rawColumns(['action','photo'])
        ->make(true);
      }

      return view('content.dashboard.users.list');
    }

    public function categorys(Request $request) {
      $categorys = Category::all();

      if($request->ajax()) {
        return DataTables::of($categorys)
        ->editColumn('id', function ($category) {
            return $category->id;
        })
        ->editColumn('name', function ($category) {
          return $category->name;
        })
        ->editColumn('image', function ($category) {
          return $category->image;
        })
        ->editColumn('created_at', function ($category) {
          return $category->created_at->format('Y-m-d');
        })
        ->addColumn('action', function ($category) {
            return '<button class="btn btn-primary">Edit</button>';
        })
        ->rawColumns(['action'])
        ->make(true);
      }

      return view('content.dashboard.blogs.list');


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
        ->editColumn('seller_id', function ($product) {
          return $product->seller->fullname;
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
      $blogs = Blog::all();

      if($request->ajax()) {
        return DataTables::of($blogs)
        ->editColumn('id', function ($blog) {
            return $blog->id;
        })
        ->editColumn('name', function ($blog) {
          return $blog->name;
        })
        ->editColumn('category_id', function ($blog) {
          return $blog->category->name;
        })
        ->editColumn('image', function ($blog) {
          return $blog->image;
        })
        ->editColumn('created_at', function ($blog) {
          return $blog->created_at->format('Y-m-d');
        })
        ->addColumn('action', function ($blog) {
            return '<button class="btn btn-primary">Edit</button>';
        })
        ->rawColumns(['action'])
        ->make(true);
      }

      return view('content.dashboard.blogs.list');

    }

    public function plans(Request $request) {
      $plans = Plan::all();

      if($request->ajax()) {
        return DataTables::of($plans)
        ->editColumn('id', function ($plan) {
            return $plan->id;
        })
        ->editColumn('name', function ($plan) {
          return $plan->name;
        })
        ->editColumn('status', function ($plan) {
          return $plan->status;
        })
        ->editColumn('image', function ($plan) {
          return $plan->image;
        })
        ->editColumn('created_at', function ($plan) {
          return $plan->created_at->format('Y-m-d');
        })
        ->addColumn('action', function ($plan) {
            return '<button class="btn btn-primary">Edit</button>';
        })
        ->rawColumns(['action'])
        ->make(true);
      }

      return view('content.dashboard.plans.list');

    }

    public function coupons(Request $request) {
      $coupons = Coupon::all();
      // coulmn for number of uses , and if uses ==== max return anouther status
      if($request->ajax()) {
        return DataTables::of($coupons)
        ->editColumn('id', function ($coupon) {
            return (string) $coupon->id;
        })
        ->editColumn('code', function ($coupon) {
          return $coupon->code;
        })
        ->editColumn('status', function ($coupon) {
          if ($coupon->max === $coupon->sell->count()) {
              return '<span class="badge rounded-pill bg-label-secondary">'. __('Stopped') .'</span>';
          }
          return '<span class="badge rounded-pill bg-label-' . ($coupon->status == 'active' ? 'success' : 'secondary') . '">'. __('Active') .'</span>';
        })
        ->editColumn('discount', function ($coupon) {
          return $coupon->discount;
        })
        ->editColumn('max', function ($coupon) {
          return $coupon->max;
        })
        ->editColumn('expired_date', function ($coupon) {
          return $coupon->expired_date->format('Y-m-d');
        })
        ->editColumn('created_at', function ($coupon) {
          return $coupon->created_at->format('Y-m-d');
        })
        ->addColumn('action', function ($coupon) {
            return '<button class="btn btn-primary">Edit</button>';
        })
        ->rawColumns(['action'])
        ->make(true);
      }

      return view('content.dashboard.coupons.list');

    }
}
