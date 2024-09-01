<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Blog;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Plan;
use App\Models\PlanPermission;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Publication;
use App\Models\Sell;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        ->editColumn('created_at', function ($user) {
          return $user->created_at->format('Y-m-d');
        })
        ->rawColumns(['photo'])
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
        ->make(true);
      }

      return view('content.dashboard.categorys.list');


    }

    public function products(Request $request) {
      // $products = Product::all();
      $query = Product::query();

      if ($request->has('category_id') && $request->category_id != 0) {
          $query->where('category_id', $request->category_id);
      }

      $products = $query->get();

      if ($request->ajax()) {
        return DataTables::of($products)
        ->editColumn('id', function ($product) {
          return (string) $product->id;
        })
        ->editColumn('price', function ($product) {
          return $product->price;
        })
        ->editColumn('subcategory_id', function ($product) {
          return $product->subcategory->getName();
        })
        ->editColumn('status', function ($product) {
          if ($product->status == 'active') {
            return '<span class="badge rounded-pill bg-label-success">'. __('Active') .'</span>';
          } else if ($product->status == 'inactive') {
            return '<span class="badge rounded-pill bg-label-secondary">'. __('In Active') .'</span>';
          }        })
        ->editColumn('image', function ($product) {
          return $product->image;
        })
        ->editColumn('name', function ($product) {
          return $product->name;
        })
        // ->editColumn('seller_id', function ($product) {
        //   return $product->seller->fullname;
        // })
        ->editColumn('created_at', function ($expert) {
          return $expert->created_at->format('Y-m-d');
        })
        ->rawColumns(['status'])
        ->make(true);
      }
      return view('content.dashboard.products.list');
    }

    public function experts(Request $request) {
      $experts = Profile::where('plan_id', 2)->get();

      if($request->ajax()) {
        return DataTables::of($experts)
        ->editColumn('id', function ($expert) {
            return (string) $expert->id;
        })
        ->editColumn('fullname', function ($expert) {
          return $expert->fullname;
        })
        ->addColumn('email', function ($expert) {
          return $expert->user->email;
        })
        ->editColumn('phone', function ($expert) {
          return $expert->phone;
        })
        ->editColumn('photo', function ($expert) {
          return '
              <img src="' . $expert->photoUrl() . '" alt="' . $expert->fullname . '" class="avatar avatar-sm rounded-circle">
          ';
        })
        ->editColumn('created_at', function ($expert) {
          return $expert->created_at->format('Y-m-d');
        })
        ->rawColumns(['photo'])
        ->make(true);
      }

      return view('content.dashboard.experts.list');

    }

    public function sellers(Request $request) {
      $sellers = Profile::where('plan_id', 3)->get();

      if($request->ajax()) {
        return DataTables::of($sellers)
        ->editColumn('id', function ($seller) {
            return (string) $seller->id;
        })
        ->addColumn('email', function ($seller) {
          return $seller->user->email;
        })
        ->editColumn('photo', function ($expert) {
          return '
              <img src="' . $expert->photoUrl() . '" alt="' . $expert->fullname . '" class="avatar avatar-sm rounded-circle">
          ';
        })
        ->editColumn('fullname', function ($seller) {
          return $seller->fullname;
        })
        ->editColumn('phone', function ($seller) {
          return $seller->phone;
        })
        ->editColumn('created_at', function ($seller) {
          return $seller->created_at->format('Y-m-d');
        })
        ->rawColumns(['photo'])
        ->make(true);
      }

      return view('content.dashboard.sellers.list');

    }

    public function workers(Request $request) {
      $workers = Profile::where('plan_id', 1)->get();

      if($request->ajax()) {
        return DataTables::of($workers)
        ->editColumn('id', function ($worker) {
            return (string) $worker->id;
        })
        ->addColumn('email', function ($worker) {
          return $worker->user->email;
        })
        ->editColumn('fullname', function ($worker) {
          return $worker->fullname;
        })
        ->editColumn('phone', function ($worker) {
          return $worker->phone;
        })
        ->editColumn('photo', function ($worker) {
          return '
              <img src="' . $worker->photoUrl() . '" alt="' . $worker->fullname . '" class="avatar avatar-sm rounded-circle">
          ';
        })
        ->editColumn('created_at', function ($worker) {
          return $worker->created_at->format('Y-m-d');
        })
        ->rawColumns(['photo'])
        ->make(true);
      }

      return view('content.dashboard.workers.list');

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
        ->rawColumns(['status','subcategory_id'])
        ->make(true);
      }

      return view('content.dashboard.blogs.list');
    }

    public function articles(Request $request) {
      $articles = Article::all();

      if($request->ajax()) {
        return DataTables::of($articles)
        ->editColumn('id', function ($article) {
            return (string) $article->id;
        })
        ->editColumn('title', function ($article) {
          return Str::limit($article->title, 35);
        })
        ->editColumn('status', function ($article) {
          return '<span class="badge rounded-pill bg-label-' . ($article->status == 'published' ? 'success' : 'secondary') . '">' . ($article->status == 'draft' ? __('Draft') : __('Published')) . '</span>';
        })
        ->editColumn('disease_id', function ($article) {
          return '<span class="badge rounded-pill bg-label-info">' . $article->disease->getName() . '</span>';
        })
        ->editColumn('type_id', function ($article) {
          return '<span class="badge rounded-pill bg-label-info">' . $article->type->getName() . '</span>';
        })
        ->editColumn('created_at', function ($article) {
          return $article->created_at->format('Y-m-d');
        })
        ->rawColumns(['type_id','disease_id'])
        ->make(true);
      }

      return view('content.dashboard.articles.list');
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
            return '<span class="badge rounded-pill bg-label-secondary">'. __('In Active') .'</span>';
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
        ->rawColumns(['image','status'])
        ->make(true);
      }

      return view('content.dashboard.plans.list');

    }

    public function plan_permissions(Request $request,$id) {
      $permissions = PlanPermission::where('plan_id', $id)->get();
      $plan = Plan::find($id);

      if($request->ajax()) {
        return DataTables::of($permissions)
        ->editColumn('id', function ($permission) {
            return (string) $permission->id;
        })
        ->editColumn('permission_id', function ($permission) {
          return $permission->permission->name;
        })
        ->editColumn('created_at', function ($permission) {
          return $permission->created_at->format('Y-m-d');
        })
        ->rawColumns(['action'])
        ->make(true);
      }

      return view('content.dashboard.plans.permissions')
      ->with('plan',$plan);
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
          if ($coupon->status == 'active') {
            return '<span class="badge rounded-pill bg-label-success">'. __('Active') .'</span>';
          } else {
            return '<span class="badge rounded-pill bg-label-secondary">'. __('In Active') .'</span>';
          }        })
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
      $user = Auth::user();

      $orders = OrderProducts::whereHas('product', function ($query) use ($user) {
        $query->where('seller_id', $user->id);
      })->get();

      if($request->ajax()) {
        return DataTables::of($orders)
        ->editColumn('id', function ($order) {
            return (string) $order->id;
        })
        ->editColumn('product_id', function ($order) {
            return $order->product->name;
        })
        ->editColumn('order_id', function ($order) {
            return $order->order->id;
        })
        ->editColumn('user_id', function ($order) {
            return $order->order->user->fullname;
        })
        ->editColumn('quantity', function ($order) {
            return $order->quantity;
        })
        ->editColumn('total', function ($order) {
            return $order->quantity * $order->price;
        })
        ->editColumn('created_at', function ($order) {
            return $order->created_at->format('Y-m-d');
        })
        ->make(true);
      }

      return view('content.dashboard.orders.list');

    }
}
