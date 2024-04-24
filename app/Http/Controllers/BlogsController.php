<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;

class BlogsController extends Controller
{
    public function index() {
      $blogs = Blog::all();
      return view('content.home.blogs.index')
      ->with('blogs', $blogs);
    }

    public function ones($id) {
      return view('content.home.blogs.ones');
    }

    public function get($id) {
      return view('content.dashboard.blogs.create');
    }

    public function create(Request $request) {
      if ($request->isMethod('GET')) {
        return view('content.dashboard.blogs.create');
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
        $blog = Blog::find($id);
        $blog->delete();
        return response()->json([
          'icon' => 'success',
          'state' => __('Success'),
          'message' => __("Deleted Successfully.")
        ]);
    }
}
