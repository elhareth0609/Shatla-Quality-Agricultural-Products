<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{

  public function index() {
    $plans = Plan::all();
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
}
