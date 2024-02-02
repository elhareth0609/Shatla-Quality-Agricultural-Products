<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;


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
    $user->role = $request->role;
    $user->save();

  }
}
