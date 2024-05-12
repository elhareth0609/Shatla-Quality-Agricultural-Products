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

  public function index() {
    $products = Product::all();
    return view('content.home.products.all')
    ->with('products', $products);
  }

  public function create_index() {
    $subcategorys = SubCategory::where('type','products')->get();
    return view('content.dashboard.products.create')
    ->with('subcategorys',$subcategorys);
  }

  public function create(Request $request) {
    $validator = Validator::make($request->all(), [
      'title' => 'required|string|max:255',
      'subcategory' => 'required|string',
      'content' => 'required|string',
      'first_image' => 'required|image|mimes:jpeg,png,jpg',
      'tags' => 'nullable|string',
      'status' => 'required|in:draft,published',
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try {
      if ($request->hasFile('first_image')) {
        $image = $request->file('first_image');
        $imageName = time() . '_' . $image->getClientOriginalName(); // Generate unique image name
        $image->move(public_path('assets/img/photos/products/'), $imageName);
      }

      $product = new Product;
      $product->title = $request->title;
      $product->content = $request->content;
      $product->status = $request->status;
      $product->subcategory_id = $request->subcategory;
      $product->user_id = Auth::user()->id;
      $product->tags = Product::TagsToString(json_decode($request->tags, true));
      $product->image = $imageName;
      $product->save();

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
        $newPhoto->image = $imageName;
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
      'title' => 'required|string|max:255',
      'subcategory' => 'required|string',
      'content' => 'required|string',
      'first_image' => 'sometimes|image|mimes:jpeg,png,jpg',
      'tags' => 'nullable|string',
      'status' => 'required|in:draft,published',
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
        $image = $request->file('first_image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('assets/img/photos/products/'), $imageName);
        $product->image = $imageName;
      }

      $product->title = $request->title;
      $product->content = $request->content;
      $product->status = $request->status;
      $product->subcategory_id = $request->subcategory;
      $product->user_id = Auth::user()->id;
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
