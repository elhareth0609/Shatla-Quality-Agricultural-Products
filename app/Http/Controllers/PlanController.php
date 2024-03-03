<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanController extends Controller
{

  public function index() {
    return view('content.dashboard.plans.index');
  }

  public function change_profile() {
    return view('content.dashboard.profiles.index');
  }

  public function change_profile_action() {

  }
}
