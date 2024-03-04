<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
      return view('content.home.carts.index');
    }

    public function checkout() {
      return view('content.home.carts.checkout');
    }


    public function create(Request $request) {

    }

    public function update(Request $request) {

    }
}
