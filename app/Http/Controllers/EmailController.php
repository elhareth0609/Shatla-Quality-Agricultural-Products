<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller {
  public function index() {
    return view('content.dashboard.email.index');
  }
  
}
