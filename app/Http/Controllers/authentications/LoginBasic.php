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
      if (Auth::attempt($credentials)) {
          // Authentication successful
          $user = Auth::user();
          $token = $user->createToken('AuthToken')->plainTextToken;

          return response()->json([
              'message' => 'Login successful',
              'token' => $token,
              'user' => $user,
          ]);
      } else {
          // Authentication failed
          return response()->json(['message' => 'Invalid credentials'], 401);
      }
  }
}
