<?php

namespace App\Http\Controllers;

use App\Models\Blog;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Publication;
use App\Models\Sell;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class DataTablesController extends Controller
{
    public function users(Request $request) {

      $users = User::where('role', 'user')->get();

      if($request->ajax()) {
        return DataTables::of($users)
        ->editColumn('id', function ($user) {
            return (string) $user->id;
        })
        ->editColumn('email', function ($user) {
          return $user->email;
        })
        ->editColumn('fullname', function ($user) {
          return $user->fullname;
        })
        ->editColumn('phone', function ($user) {
          return $user->phone;
        })
        ->editColumn('photo', function ($user) {
            return '
                <img src="' . $user->photoUrl() . '" alt="' . $user->fullname . '" class="avatar avatar-sm rounded-circle">
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
            return (string) $category->id;
        })
        ->editColumn('name', function ($category) {
          return $category->getName();
        })
        ->editColumn('image', function ($category) {
          return $category->image;
        })
        ->editColumn('created_at', function ($category) {
          return $category->created_at->format('Y-m-d');
        })
        ->addColumn('action', function ($category) {
            return '<a href="#"><span class="tf-icons mdi mdi-plus-outline"></span></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
      }

      return view('content.dashboard.categorys.list');


    }

    public function products(Request $request) {
      $products = Product::all();
      if ($request->ajax()) {
        return DataTables::of($products)
        ->editColumn('id', function ($product) {
          return (string) $product->id;
        })
        ->editColumn('price', function ($product) {
          return $product->price;
        })
        ->editColumn('subcategory_id', function ($product) {
          return $product->subcategory->name;
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
            return (string) $expert->id;
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
            return (string) $seller->id;
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
            return (string) $blog->id;
        })
        ->editColumn('title', function ($blog) {
          return Str::limit($blog->title, 35);
        })
        ->editColumn('status', function ($blog) {
          return '<span class="badge rounded-pill bg-label-' . ($blog->status == 'published' ? 'success' : 'secondary') . '">' . ($blog->status == 'draft' ? __('Draft') : __('Published')) . '</span>';
        })
        ->editColumn('subcategory_id', function ($blog) {
          return '<span class="badge rounded-pill bg-label-info">' . $blog->subcategory->getName() . '</span>';
        })
        ->editColumn('created_at', function ($blog) {
          return $blog->created_at->format('Y-m-d');
        })
        ->addColumn('action', function ($blog) {
            return '<button class="btn btn-primary">Edit</button>';
        })
        ->rawColumns(['action','status','subcategory_id'])
        ->make(true);
      }

      return view('content.dashboard.blogs.list');
    }

    public function plans(Request $request) {
      $plans = Plan::where('name', '!=', 'المسؤول')->get();

      if($request->ajax()) {
        return DataTables::of($plans)
        ->editColumn('id', function ($plan) {
            return (string) $plan->id;
        })
        ->editColumn('name', function ($plan) {
          return $plan->name;
        })
        ->editColumn('status', function ($plan) {
          if ($plan->status == 1) {
            return '<span class="badge rounded-pill bg-label-success">'. __('Active') .'</span>';
          } else {
            return '<span class="badge rounded-pill bg-label-secondary">'. __('InActive') .'</span>';

          }
        })
        ->editColumn('image', function ($plan) {
          return '
              <img src="' . $plan->photoUrl() . '" alt="' . $plan->name . '" class="avatar avatar-sm rounded-circle">
          ';
        })
        ->editColumn('created_at', function ($plan) {
          return $plan->created_at->format('Y-m-d');
        })
        // ->addColumn('action', function ($plan) {
        //     return '<button class="btn btn-primary">Edit</button>';
        // })
        ->rawColumns(['action','image','status'])
        ->make(true);
      }

      return view('content.dashboard.plans.list');

    }

    public function coupons(Request $request) {
      $coupons = Coupon::all();
      if($request->ajax()) {
        return DataTables::of($coupons)
        ->editColumn('id', function ($coupon) {
            return (string) $coupon->id;
        })
        ->editColumn('code', function ($coupon) {
          return $coupon->code;
        })
        ->editColumn('status', function ($coupon) {
          // if ($coupon->max === $coupon->sell->count()) {
          //     return '<span class="badge rounded-pill bg-label-secondary">'. __('Stopped') .'</span>';
          // }
          return '<span class="badge rounded-pill bg-label-' . ($coupon->status == 'active' ? 'success' : 'secondary') . '">' . ($coupon->status == 'active' ? 'Active' : 'In Active') . '</span>';
        })
        ->editColumn('discount', function ($coupon) {
          return $coupon->discount;
        })
        ->editColumn('max', function ($coupon) {
          return $coupon->max;
        })
        ->editColumn('expired_date', function ($coupon) {
          return $coupon->expired_date;
        })
        ->editColumn('created_at', function ($coupon) {
          return $coupon->created_at->format('Y-m-d');
        })
        ->rawColumns(['status'])
        ->make(true);
      }

      return view('content.dashboard.coupons.list');

    }

    public function category_subcategorys(Request $request,$id) {
      $subcategorys = SubCategory::where('category_id', $id)->get();
      $category = Category::find($id);

      if($request->ajax()) {
        return DataTables::of($subcategorys)
        ->editColumn('id', function ($subcategory) {
            return (string) $subcategory->id;
        })
        ->editColumn('name', function ($subcategory) {
          return $subcategory->getName();
        })
        ->editColumn('image', function ($subcategory) {
          return $subcategory->image;
        })
        ->editColumn('created_at', function ($subcategory) {
          return $subcategory->created_at->format('Y-m-d');
        })
        ->addColumn('action', function ($subcategory) {
          return '<a href="#"><span class="tf-icons mdi mdi-plus-outline"></span></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
      }

      return view('content.dashboard.categorys.subcategorys')
      ->with('category',$category);


    }

    public function publications(Request $request) {
      $publications = Publication::all();

      if($request->ajax()) {
        return DataTables::of($publications)
        ->editColumn('id', function ($publication) {
            return (string) $publication->id;
        })
        ->editColumn('title', function ($blog) {
          return Str::limit($blog->title, 35);
        })
        ->editColumn('status', function ($blog) {
          return '<span class="badge rounded-pill bg-label-' . ($blog->status == 'published' ? 'success' : 'secondary') . '">' . ($blog->status == 'draft' ? __('Draft') : __('Published')) . '</span>';
        })
        ->editColumn('created_at', function ($publication) {
          return $publication->created_at->format('Y-m-d');
        })
        ->rawColumns(['status'])
        ->make(true);
      }

      return view('content.dashboard.publications.list');

    }

    public function orders(Request $request) {
      $publications = Publication::all();

      if($request->ajax()) {
        return DataTables::of($publications)
        ->editColumn('id', function ($publication) {
            return (string) $publication->id;
        })
        ->editColumn('title', function ($publication) {
          return $publication->title;
        })
        ->editColumn('category_id', function ($publication) {
          return $publication->category->name;
        })
        ->editColumn('image', function ($publication) {
          return $publication->image;
        })
        ->editColumn('created_at', function ($publication) {
          return $publication->created_at->format('Y-m-d');
        })
        ->addColumn('action', function ($publication) {
            return '<button class="btn btn-primary">Edit</button>';
        })
        ->rawColumns(['action'])
        ->make(true);
      }

      return view('content.dashboard.orders.list');

    }
}
