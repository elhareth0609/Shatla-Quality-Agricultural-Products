<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index() {
      return view('content.home.index');
    }

    public function contact() {
      return view('content.home.pages.contact');
    }
}
