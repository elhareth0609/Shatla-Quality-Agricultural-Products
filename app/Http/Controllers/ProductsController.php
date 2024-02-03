<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductsController extends Controller
{
  public function create(Request $request) {

    return response()->json([
      'state' => 'deleted',
      'message' => 'The Product Created Successfully.'
    ]);
  }

  public function update(Request $request) {

    return response()->json([
      'state' => 'deleted',
      'message' => 'The Product Updated Successfully.'
    ]);
  }

  public function delete($id) {
      $product = Product::find($id);
      $product->delete();
      return response()->json([
        'state' => 'deleted',
        'message' => 'The Product Deleted Successfully.'
      ]);
  }

}
