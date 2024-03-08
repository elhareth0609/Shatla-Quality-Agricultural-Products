<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
  public function change(Request $request, $currency)
  {
    session()->put('currency', $currency);
    return redirect()->back();
  }

}
