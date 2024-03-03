<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function login(Request $request) {
        $request->validate([
          'email' => 'required|email',
          'password' => 'required'
        ]);

      $credentials = $request->only('email', 'password');
      $remember = $request->has('remember');
      if (Auth::attempt($credentials,$remember)) {
          Auth::user();
          return redirect('/');
      } else {
          return redirect()->back()->withErrors(['message' => 'Invalid credentials'])->withInput();
      }
  }

  public function redirectToGoogle() {
    return Socialite::driver('google')->redirect();
  }

  public function handleGoogleCallback() {
    $googleUser = Socialite::driver('google')->user();

    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        $user = new User;
        $user->email = $googleUser->getEmail();
        $user->fullname = $googleUser->getName();
        $user->photo = $googleUser->getAvatar();
        $user->save();
      }

      Auth::login($user);

    return redirect()->route('home');
  }

  public function redirectToFacebook() {
    return Socialite::driver('facebook')->redirect();
  }

  public function handleFacebookCallback() {
    $facebookUser = Socialite::driver('facebook')->user();

    $user = User::where('email', $facebookUser->getEmail())->first();

    if (!$user) {
        $user = new User;
        $user->email = $facebookUser->getEmail();
        $user->fullname = $facebookUser->getName();
        $user->photo = $facebookUser->getAvatar();
        $user->save();
      }

      Auth::login($user);

    return redirect()->route('home');
  }

  public function logout() {
    Auth::logout();

    return redirect()->route('home');

  }
}
