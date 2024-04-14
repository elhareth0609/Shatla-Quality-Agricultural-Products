<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
  public function create(Request $request) {
      $validator = Validator::make($request->all(), [
          'code' => 'required|string|unique:coupons',
          'max' => 'required|integer|min:1',
          'discount' => 'required|integer|min:1|max:100',
          'expired_date' => 'required|date',
          'status' => 'required|in:active,inactive',
        ]);

      if ($validator->fails()) {
          return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $validator->errors()->first()
          ], 422);
      }

      try{

        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->max = $request->max;
        $coupon->discount = $request->discount;
        $coupon->expired_date = $request->expired_date;
        $coupon->status = $request->status;
        $coupon->save();

        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Coupon Created successfully")
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
      'code' => [
        'required',
        'string',
        Rule::unique('coupons')->ignore($request->id),
      ],
      'max' => 'required|integer|min:1',
      'discount' => 'required|integer|min:1|max:100',
      'expired_date' => 'required|date',
      'status' => 'required|boolean',
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try{

      $coupon = Coupon::find($request->id);
      $coupon->code = $request->code;
      $coupon->max = $request->max;
      $coupon->discount = $request->discount;
      $coupon->expired_date = $request->expired_date;
      $coupon->status = $request->status;
      $coupon->save();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Coupon Updated Successfully.")
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
        $coupon = Coupon::find($id);
        $coupon->delete();
        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Coupon Deleted successfully")
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
