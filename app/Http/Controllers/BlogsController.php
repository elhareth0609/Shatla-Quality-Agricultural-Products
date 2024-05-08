<?php

namespace App\Http\Controllers;

use App\Models\Blog;

use App\Models\BlogComment;
use App\Models\BlogPhoto;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogsController extends Controller
{
    public function index() {
      $blogs = Blog::all();
      return view('content.home.blogs.index')
      ->with('blogs', $blogs);
    }

    public function ones($id) {
      $blog = Blog::find($id);
      $blog->view += 1;
      $blog->save();
      return view('content.home.blogs.ones')
      ->with('blog', $blog);
    }

    public function get($id) {
      $blog = Blog::find($id);
      $subcategorys = SubCategory::where('type','blogs')->get();
      return view('content.dashboard.blogs.index')
      ->with('subcategorys',$subcategorys)
      ->with('blog',$blog);
    }

    public function create_index() {
      $subcategorys = SubCategory::where('type','blogs')->get();
      return view('content.dashboard.blogs.create')
      ->with('subcategorys',$subcategorys);
    }

    public function create(Request $request) {
      $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'subcategory' => 'required|string',
        'content' => 'required|string',
        'first_image' => 'required|image|mimes:jpeg,png,jpg',
        'tags' => 'nullable|string',
        'status' => 'required|in:draft,published',
      ]);

      if ($validator->fails()) {
          return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $validator->errors()->first()
          ], 422);
      }

      try {
        if ($request->hasFile('first_image')) {
          $image = $request->file('first_image');
          $imageName = time() . '_' . $image->getClientOriginalName(); // Generate unique image name
          $image->move(public_path('assets/img/photos/blogs/'), $imageName);
        }

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->subcategory_id = $request->subcategory;
        $blog->user_id = Auth::user()->id;
        $blog->tags = Blog::TagsToString(json_decode($request->tags, true));
        $blog->image = $imageName;
        $blog->save();

        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Created Successfully."),
          'id' => $blog->id
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $e->getMessage(),
        ]);
      }
  }

    public function uploadPhotos(Request $request) {
      $validator = Validator::make($request->all(), [
        'blog_id' => 'required|string',
        'file' => 'required|image|mimes:jpeg,png,jpg', // Validate each file in the array
      ]);

      if ($validator->fails()) {
          return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $validator->errors()->first()
          ], 422);
      }

      try {

          $image = $request->file('file');
          $imageName = time() . '_' . $image->getClientOriginalName();
          $image->move(public_path('assets/img/photos/blogs/'), $imageName);

          $newPhoto = new BlogPhoto();
          $newPhoto->blog_id = $request->blog_id;
          $newPhoto->image = $imageName;
          $newPhoto->save();

        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Created Successfully.")
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

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Updated Successfully.")
      ]);
    }

    public function delete($id) {
        $blog = Blog::find($id);
        $blog->delete();
        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Deleted Successfully.")
        ]);
    }

    public function comment(Request $request) {

      $comment = new BlogComment();
      $comment->content = $request->content;
      $comment->profile_id = Auth::user()->profile->id;
      $comment->blog_id = $request->blog_id;
      $comment->save();

      $comment->photo = Auth::user()->profile->photoUrl();
      $comment->fullname = Auth::user()->profile->fullname;
      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Commented Successfully."),
        'comment' => $comment
      ]);
    }
}
