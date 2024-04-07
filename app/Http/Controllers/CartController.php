<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nnjeim\World\World;

class CartController extends Controller
{
    public function index() {
      return view('content.home.carts.index');
    }
    
    public function checkout() {
      $countries =  World::countries();
      return view('content.home.carts.checkout')
      ->with('countries',$countries->data);
    }


    public function create(Request $request) {

    }

    public function update(Request $request) {

    }
}
