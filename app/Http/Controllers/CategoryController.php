<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
  public function create(Request $request) {

    return response()->json([
      'state' => 'deleted',
      'message' => 'The Category Created Successfully.'
    ]);
  }

  public function update(Request $request) {

    return response()->json([
      'state' => 'deleted',
      'message' => 'The Category Updated Successfully.'
    ]);
  }

  public function delete($id) {
      $category = Category::find($id);
      $category->delete();
      return response()->json([
        'state' => 'deleted',
        'message' => 'The Category Deleted Successfully.'
      ]);
  }

}
