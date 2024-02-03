<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index() {
      return view('content.dashboard.settings.index');
    }

    public function privacy_and_policy() {
      return view('content.home.pages.privacy-and-policy');
    }


    public function terms_of_use() {
      return view('content.home.pages.terms-of-use');
    }


    public function about_us() {
      return view('content.home.pages.about-us');
    }

    public function get_privacy_and_policy() {
      return view('content.dashboard.settings.privacy-and-policy');
    }


    public function get_terms_of_use() {
      return view('content.dashboard.settings.terms-of-use');
    }


    public function get_about_us() {
      return view('content.dashboard.settings.about-us');
    }

    public function update_privacy_and_policy() {
      return view('content.dashboard.settings.privacy-and-policy');
    }


    public function update_terms_of_use() {
      return view('content.dashboard.settings.terms-of-use');
    }


    public function update_about_us() {
      return view('content.dashboard.settings.about-us');
    }
}
