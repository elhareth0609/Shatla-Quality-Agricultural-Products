<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function experts(Request $request) {
      return view('content.home.pages.agriculturel-experts');
    }


    public function services(Request $request) {
      return view('content.home.pages.agriculturel-services');
    }

    public function consultation(Request $request) {
      return view('content.home.pages.agriculturel-consultation');
    }
}
