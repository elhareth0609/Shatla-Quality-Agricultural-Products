<?php

namespace App\Http\Controllers;

use App\Events\PublicationDeleted;
use App\Models\Coupon;
use Carbon\Carbon;
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

  public function check(Request $request) {
    $state = false;
    $message = '';

    $coupon = Coupon::where('code', $request->code)->first();

    if ($coupon) {
        if ($coupon->max >= $coupon->users->count()) {
          $state = true;
          $message = __('Coupon code applied successfully.');
          $discount = $coupon->discount;
        } else {
          $message = __('Maximum usage limit for this coupon has been reached.');
          $state = false;
          $discount = 0;
        }

        if ($coupon->expired_date && Carbon::parse($coupon->expired_date)->isPast()) {
          $state = false;
          $message = __('Coupon code has expired.');
          $discount = 0;
        }


        if ($coupon->status == 'inactive') {
          $state = false;
          $message = __('Coupon code has inactive.');
          $discount = 0;
      }
    } else {
        $state = false;
        $message = __('Invalid coupon code.');
        $discount = 0;
    }

    return response()->json([
        'message' => $message,
        'state' => $state,
        'discount' => $discount
    ]);
}

  public function delete($id) {
      try{
        $coupon = Coupon::find($id);
        $coupon->delete();
        event(new PublicationDeleted($id));

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
