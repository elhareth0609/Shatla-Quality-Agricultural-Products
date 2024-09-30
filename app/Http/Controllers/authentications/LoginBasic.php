<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class LoginBasic extends Controller
{
  public function index() {
    return view('content.authentications.auth-login-basic');
  }

  public function login(Request $request) {
      $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
        'remember' => 'sometimes'
      ]);

      if ($validator->fails()) {
          return response()->json([
          'message' => $validator->errors()->first()
          ], 422);
      }

      try {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        if (Auth::attempt($credentials,$remember)) {
            return response()->json([
              'message' => __("Login successful"),
            ], 200);
        } else {
          return response()->json([
            'message' => __("Invalid credentials"),
          ], 201);
        }
      } catch (\Exception $e) {
        return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $e->getMessage(),
        ], 201);
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

        $profile = new Profile;
        $profile->fullname = $googleUser->getName();
        $profile->photo = $googleUser->getAvatar();
        $profile->user_id = $user->id;
        $profile->plan_id = 0;
        $profile->active = '1';
        $profile->save();

        $cart = new Cart;
        $cart->user_id = $user->id;
        $cart->save();
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

        $profile = new Profile;
        $profile->fullname = $facebookUser->getName();
        $profile->photo = $facebookUser->getAvatar();
        $profile->user_id = $user->id;
        $profile->plan_id = 0;
        $profile->active = '1';
        $profile->save();

        $cart = new Cart;
        $cart->user_id = $user->id;
        $cart->save();
      }

      Auth::login($user);

    return redirect()->route('home');

  }

  public function change(Request $request) {
    $validator = Validator::make($request->all(), [
      'newPassword' => 'required|min:8',
      'confirmPassword' => 'required|same:newPassword',
      'currentPassword' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try {
      if (!Auth::attempt(['email' => Auth::user()->email, 'password' => $request->currentPassword])) {
          return response()->json([
            'icon' => 'error',
            'state' => __("Error"),
            'message' => __("Current password is incorrect."),
          ]);
      }

      $user = User::find(Auth::user()->id);
      $user->password = bcrypt($request->newPassword);
      $user->save();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Password changed successfully.")
      ]);

    } catch (\Exception $e) {
      return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $e->getMessage(),
      ]);
    }
  }

  public function update(Request $request) {
      $validator = Validator::make($request->all(), [
        'fullname' => 'required|string',
        'email' => 'required|string|email',
        'phone' => 'nullable|string|max:15',
        'image' => 'sometimes|image|mimes:jpeg,png,jpg', // Adjust image validation rules as needed
      ]);

      if ($validator->fails()) {
          return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $validator->errors()->first()
          ], 422);
      }

      try {

        $profile = Profile::where('user_id',Auth::user()->id)->where('active', '1')->first();
          if ($request->hasFile('image')) {
            if (Auth::user()->profile->photoPath()) {
              Storage::disk('public')->delete('assets/img/photos/users/' . Auth::user()->profile->photo);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Generate unique image name
            $image->move(public_path('assets/img/photos/users/'), $imageName);
            $profile->photo = $imageName;
          }

          $profile->fullname = $request->fullname;
          $profile->phone = $request->phone;
          $profile->save();

          $user = User::find(Auth::user()->id);
          $user->email = $request->email;
          $user->save();

        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Profile details updated successfully.")
        ]);

      } catch (\Exception $e) {
        return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $e->getMessage(),
        ]);
      }
  }

  public function logout() {
    Auth::logout();

    return redirect()->route('home');

  }
}
