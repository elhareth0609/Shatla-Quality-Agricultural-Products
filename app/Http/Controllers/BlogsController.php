<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;

class BlogsController extends Controller
{
    public function create(Request $request) {

      return response()->json([
        'state' => 'deleted',
        'message' => 'The Blog Created Successfully.'
      ]);
    }

    public function update(Request $request) {

      return response()->json([
        'state' => 'deleted',
        'message' => 'The Blog Updated Successfully.'
      ]);
    }

    public function delete($id) {
        $blog = Blog::find($id);
        $blog->delete();
        return response()->json([
          'state' => 'deleted',
          'message' => 'The Blog Deleted Successfully.'
        ]);
    }
}
