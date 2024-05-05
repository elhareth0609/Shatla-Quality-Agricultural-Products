<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        'state' => __('Success'),
        'message' => __("Created Successfully.")
      ]);
    }

    public function update(Request $request) {

      return response()->json([
        'icon' => 'success',
        'state' => __('Success'),
        'message' => __("Updated Successfully.")
      ]);
    }

    public function delete($id) {
        $plan = Plan::find($id);
        $plan->delete();
        return response()->json([
          'icon' => 'success',
          'state' => __('Success'),
          'message' => __("Deleted Successfully.")
        ]);
    }

    public function permissions($id) {
      $plan = Plan::find($id);
      return view('content.dashboard.plan.permissions')
      ->with('plan',$plan);
    }

    public function add(Request $request) {
    
      return response()->json([
        'icon' => 'success',
        'state' => __('Success'),
        'message' => __("Created Successfully.")
      ]);
    }

}
