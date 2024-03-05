<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
  public function change(Request $request, $locale)
  {
      // Set the application locale
      app()->setLocale($locale);

      // Store the selected language in the session or any other storage mechanism if needed
      // For example, you can store it in the session
      $request->session()->put('locale', $locale);

      // Redirect back to the previous URL or any other page
      return back();
  }
}
