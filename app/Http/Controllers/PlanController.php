<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Profile;
use Chargily\ePay\Chargily;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
  public function index() {
    $plans = Plan::where('name','!=','المسؤول')->get();
    return view('content.home.pages.plans')
    ->with('plans',$plans);
  }

  public function change_profile() {
    return view('content.dashboard.profiles.index');
  }

  public function change_profile_action(Request $request) {
    Auth::user()->profile->update(['active' => '0']);

    $profile = Profile::findOrFail($request->profile_id);
    $profile->update(['active' => '1']);

    return response()->json([
      'success' => true
    ]);

  }

    public function get($id) {
      $plan = Plan::find($id);
      return view('content.dashboard.plans.index')
      ->with('plan',$plan);
    }


    public function create(Request $request) {
      if ($request->isMethod('GET')) {
        return view('content.dashboard.plans.create');
      }

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Created Successfully.")
      ]);
    }

    public function update(Request $request) {

      $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'text' => 'required|string',
        'status' => 'required|in:0,1',
        'price' => 'required|numeric|min:0',
        'last_price' => 'nullable|numeric|min:0',
        'image' => 'sometimes|image|mimes:jpeg,png,jpg', // Adjust image validation rules as needed
      ]);

      if ($validator->fails()) {
          return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $validator->errors()->first()
          ], 422);
      }

      try {

        $plan = Plan::find($request->pid);
          if ($request->hasFile('image')) {
            if ($plan->photoPath()) {
              Storage::disk('public')->delete('assets/img/photos/plans/' . $plan->photo);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Generate unique image name
            $image->move(public_path('assets/img/photos/plans/'), $imageName);
            $plan->photo = $imageName;
          }

          $plan->name = $request->name;
          $plan->text = $request->text;
          $plan->price = $request->price;
          $plan->last_price = $request->last_price;
          $plan->status = $request->status;
          $plan->save();


        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Updated Successfully.")
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
        $plan = Plan::find($id);
        $plan->delete();
        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Deleted Successfully.")
        ]);
    }

    public function permissions($id) {
      $plan = Plan::find($id);
      return view('content.dashboard.plans.permissions')
      ->with('plan',$plan);
    }

    public function add(Request $request) {
      $plan = Plan::find($request->plan);

      $chargilyConfig = config('chargily');

      $chargily = new Chargily([
          'api_key' => $chargilyConfig['key'],
          'api_secret' => $chargilyConfig['secret'],
          'urls' => [
              // 'back_url' => route('chargily.payment.success'),
              // 'webhook_url' => route('chargily.payment.webhook'),
              'back_url' => 'https://example.com/chargily/payment/success',
              'webhook_url' => 'https://example.com/chargily/payment/webhook',
          ],
          'mode' => 'EDAHABIA',
          'payment' => [
              'number' => 'payment-number-from-your-side',
              'client_name' => Auth::user()->profile->fullname,
              'client_email' => Auth::user()->email,
          'amount' => $plan->price,
          'discount' => 0,
          'description' => $plan->name,
        ]
      ]);

      $redirectUrl = $chargily->getRedirectUrl();

      if ($redirectUrl) {
          return response()->json([
            'url' => $redirectUrl
          ]);
      } else {
          return "We can't redirect to your payment now";
      }
    }
}
