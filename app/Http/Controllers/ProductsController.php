<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller {

  public function moreHome(Request $request) {
      $page = $request->get('page', 1);
      $perPage = 12;
      $products = Product::where('status', 'active')
                  ->orderBy('created_at', 'desc')
                  ->skip(($page - 1) * $perPage)
                  ->take($perPage)
                  ->get();

      $html = '';
      foreach ($products as $product) {
          $html .= view('components.product', ['product' => $product])->render();
      }

      $hasMore = Product::where('status', 'active')->count() > $page * $perPage;

      return response()->json(['products' => $products->map(function($product) {
          return [
              'id' => $product->id,
              'html' => view('components.product', ['product' => $product])->render(),
          ];
      }), 'hasMore' => $hasMore]);
  }

  public function index() {
    $products = Product::where('status','active')->orderBy('created_at', 'desc')->take(16)->get();
    return view('content.home.products.all')
    ->with('products', $products);
  }

  public function view($id) {
    $product = Product::find($id);
    $product->view += 1;
    $product->save();
    return view('content.home.products.index')
    ->with('product',$product);
  }

  public function get($id) {
    $product = Product::find($id);
    $subcategorys = SubCategory::where('type','products')->get();
    return view('content.dashboard.products.index')
    ->with('subcategorys',$subcategorys)
    ->with('product',$product);
  }


  public function create_index() {
    $subcategorys = SubCategory::where('type','products')->get();
    return view('content.dashboard.products.create')
    ->with('subcategorys',$subcategorys);
  }

  public function create(Request $request) {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'content' => 'required|string',
      'price' => 'required|numeric|min:0',
      'last_price' => 'nullable|numeric|min:0',
      'quantity' => 'required|numeric|min:0',
      'amount_price' => 'nullable|numeric|min:0',
      'description' => 'required|string',
      'status' => 'required|in:active,inactive',
      'percentage' => 'nullable|numeric|min:0|max:100',
      'subcategory' => 'required|exists:sub_categories,id',
      'tags' => 'nullable|string',
      'first_image' => 'required|image|mimes:jpeg,png,jpg',
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try {

      $product = new Product();
      $product->name = $request->name;
      $product->content = $request->content;
      $product->price = $request->price;
      $product->last_price = $request->last_price;
      $product->amount_price = $request->amount_price;
      $product->description = $request->description;
      $product->status = $request->status;
      $product->quantity = $request->quantity;
      $product->percentage = $request->percentage;
      $product->subcategory_id = $request->subcategory;
      $product->seller_id = Auth::user()->id;
      $product->tags = Product::TagsToString(json_decode($request->tags, true));
      $product->save();

      if ($request->hasFile('first_image')) {
        $image = $request->file('first_image');
        $imageName = time() . '_' . $image->getClientOriginalName(); // Generate unique image name
        $image->move(public_path('assets/img/photos/products/'), $imageName);

        $photo = new ProductPhoto();
        $photo->product_id = $product->id;
        $photo->photo = $imageName;
        $photo->type = '1';
        $photo->typeof = '0';
        $photo->save();
      }

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Created Successfully."),
        'id' => $product->id
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $e->getMessage(),
      ]);
    }
}

  public function uploadPhotos(Request $request) {
    $validator = Validator::make($request->all(), [
      'product_id' => 'required|string',
      'typeof' => 'required',
      'file' => 'required|image|mimes:jpeg,png,jpg', // Validate each file in the array
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try {

        $image = $request->file('file');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('assets/img/photos/products/'), $imageName);

        $newPhoto = new ProductPhoto();
        $newPhoto->product_id = $request->product_id;
        $newPhoto->photo = $imageName;
        $newPhoto->typeof = $request->typeof;
        $newPhoto->save();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Created Successfully.")
      ]);

    } catch (\Exception $e) {
      return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $e->getMessage(),
      ]);
    }
  }

  public function unuploadPhotos(Request $request,$id) {
      try {
        $photo = ProductPhoto::find($id);

        $filePath = public_path('assets/img/photos/products/') . $photo->image;

        if (file_exists($filePath)) {
          unlink($filePath);
        }

        $photo->delete();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Deleted Successfully.")
      ]);

    } catch (\Exception $e) {
      return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $e->getMessage(),
      ]);
    }
  }

  public function update(Request $request) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'content' => 'required|string',
      'price' => 'required|numeric|min:0',
      'last_price' => 'nullable|numeric|min:0',
      'quantity' => 'required|numeric|min:0',
      'amount_price' => 'nullable|numeric|min:0',
      'description' => 'required|string',
      'status' => 'required|in:active,inactive',
      'percentage' => 'nullable|numeric|min:0|max:100',
      'subcategory' => 'required|exists:sub_categories,id',
      'tags' => 'nullable|string',
      'first_image' => 'sometimes|image|mimes:jpeg,png,jpg',
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try {
      $product = Product::find($request->id);
      if ($request->hasFile('first_image')) {
        $photo = ProductPhoto::where('product_id', $product->id)->where('type', 1)->first();

        $filePath = public_path('assets/img/photos/products/') . $photo->photo;
        if (file_exists($filePath)) {
          unlink($filePath);
        }

        $image = $request->file('first_image');
        $imageName = time() . '_' . $image->getClientOriginalName(); // Generate unique image name
        $image->move(public_path('assets/img/photos/products/'), $imageName);

        $photo->photo = $imageName;
        $photo->save();

      }

      $product->name = $request->name;
      $product->content = $request->content;
      $product->price = $request->price;
      $product->last_price = $request->last_price;
      $product->amount_price = $request->amount_price;
      $product->description = $request->description;
      $product->status = $request->status;
      $product->quantity = $request->quantity;
      $product->percentage = $request->percentage;
      $product->subcategory_id = $request->subcategory;
      $product->tags = Product::TagsToString(json_decode($request->tags, true));
      $product->save();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Updated Successfully."),
        'id' => $product->id
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $e->getMessage(),
      ]);
    }

  }

  public function delete($id) {
      $product = Product::find($id);

      foreach($product->photos() as $image) {
        $filePath = public_path('assets/img/photos/products/') . $image->photo;
        if (file_exists($filePath)) {
          unlink($filePath);
        }
      }

      $product->delete();
      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Deleted Successfully.")
      ]);
  }


  public function comment(Request $request) {
    $validator = Validator::make($request->all(), [
      'content' => 'required|string',
      'product_id' => 'required|string',
      'rating' => 'required|in:1,2,3,4,5',
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try{

      $coupon = new Comment();
      $coupon->content = $request->content;
      $coupon->stars = $request->rating;
      $coupon->user_id = $request->user()->id;
      $coupon->product_id = $request->product_id;
      $coupon->save();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Commented successfully")
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $e->getMessage()
      ]);
    }

  }

}
