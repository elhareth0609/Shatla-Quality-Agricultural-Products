<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function create(Request $request) {
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
