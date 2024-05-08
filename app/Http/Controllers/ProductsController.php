<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

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
    return view('content.dashboard.products.index')
    ->with('product',$product);
  }

  public function create(Request $request) {

    return response()->json([
      'icon' => 'success',
      'state' => __("Success"),
      'message' => __("Created Successfully.")
    ]);
  }

  public function update(Request $request) {

    return response()->json([
      'icon' => 'success',
      'state' => __("Success"),
      'message' => __("Updated Successfully.")
    ]);
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

}
