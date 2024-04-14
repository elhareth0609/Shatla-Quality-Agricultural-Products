<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
  public function create(Request $request) {
    $validator = Validator::make($request->all(), [
        'scname' => 'required|string',
      ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try{

      $Subcategory = new SubCategory();
      $Subcategory->name = $request->scname;
      $Subcategory->category_id = $request->category_id;
      $Subcategory->save();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("SubCategory Created successfully")
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
      'scname' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try{

      $Subcategory = SubCategory::find($request->id);
      $Subcategory->name = $request->scname;
      $Subcategory->save();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("SubCategory Updated Successfully.")
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
      $Subcategory = SubCategory::find($id);
      $Subcategory->delete();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("SubCategory Deleted successfully")
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
