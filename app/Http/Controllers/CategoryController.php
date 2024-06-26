<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller {

  public function create(Request $request) {
    $validator = Validator::make($request->all(), [
        'cname' => 'required|string',
      ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try{

      $category = new Category();
      $category->name = $request->cname;
      $category->save();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Category Created successfully")
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $e->getMessage()
      ]);
    }

  }

  public function update(Request $request) {
    $validator = Validator::make($request->all(), [
      'id' => 'required|string',
      'cname' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try{

      $category = Category::find($request->id);
      $category->name = $request->cname;
      $category->save();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Category Updated Successfully.")
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $e->getMessage()
      ]);
    }

  }

  public function delete($id) {
    try{
      $category = Category::find($id);
      $category->delete();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Category Deleted successfully")
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
