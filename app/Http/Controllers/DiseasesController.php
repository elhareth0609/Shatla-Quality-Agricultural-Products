<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiseasesController extends Controller
{
    public function index() {
      return view('home.diseases.index');
    }

    public function predict(Request $request) {
      
    }
}
