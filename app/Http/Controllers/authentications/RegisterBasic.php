<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\Cart;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;


class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }

  public function register(Request $request) {


    $user = new User();
    $user->fullname = $request->fullname;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->password = $request->password;
    $user->role = 'user';
    $user->save();

    $profile = new Profile;
    $profile->fullname = $request->fullname;
    $profile->phone = $request->phone;
    $profile->user_id = $user->id;
    $profile->plan_id = 0;
    $profile->active = '1';
    $profile->save();

    $cart = new Cart;
    $cart->user_id = $user->id;
    $cart->save();

    return redirect()->route('login');

  }
}
