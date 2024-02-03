<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function login(Request $request) {
        // Validate the incoming request data
        $request->validate([
          'email' => 'required|email',
          'password' => 'required',
        ]);

      // Attempt to authenticate the user
      $credentials = $request->only('email', 'password');
      $remember = $request->has('remember'); // Check if "Remember Me" checkbox is checked
      if (Auth::attempt($credentials,$remember)) {
          // Authentication successful
          $user = Auth::user();
          return redirect('/');
      } else {
          // Authentication failed
          return redirect()->back()->withErrors(['message' => 'Invalid credentials'])->withInput();
      }
  }

  public function logout() {
    Auth::logout();

    return redirect('/');

  }
}
