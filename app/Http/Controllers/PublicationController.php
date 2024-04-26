<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
  public function index() {
    $publications = Publication::all();
    return view('content.home.publications.index')
    ->with('blogs', $publications);
  }

  public function ones($id) {
    return view('content.home.publications.ones');
  }

  public function get($id) {
    return view('content.dashboard.publications.create');
  }

  public function create(Request $request) {
    if ($request->isMethod('GET')) {
      return view('content.dashboard.publications.create');
    }

    return response()->json([
      'icon' => 'success',
      'state' => __('Success'),
      'message' => __("Created Successfully.")
    ]);
  }

  public function update(Request $request) {

    return response()->json([
      'icon' => 'success',
      'state' => __('Success'),
      'message' => __("Updated Successfully.")
    ]);
  }

  public function delete($id) {
      $blog = Publication::find($id);
      $blog->delete();
      return response()->json([
        'icon' => 'success',
        'state' => __('Success'),
        'message' => __("Deleted Successfully.")
      ]);
  }
}
