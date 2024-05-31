<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticlePhoto;
use App\Models\Disease;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
  public function index() {
    $articles = Article::all();
    return view('content.home.articles.index')
    ->with('articles', $articles);
  }

  public function ones($id) {
    $article = Article::find($id);
    return view('content.home.articles.ones')
    ->with('article', $article);
  }

  public function get($id) {
    $article = Article::find($id);
    $types = Type::all();
    $diseases = Disease::all();
    return view('content.dashboard.articles.index')
    ->with('types',$types)
    ->with('diseases',$diseases)
    ->with('article',$article);
  }

  public function create_index() {
    $types = Type::all();
    $diseases = Disease::all();
    return view('content.dashboard.articles.create')
    ->with('types',$types)
    ->with('diseases',$diseases);
  }

  public function create(Request $request) {
    $validator = Validator::make($request->all(), [
      'title' => 'required|string|max:255',
      'disease' => 'required|string',
      'type' => 'required|string',
      'content' => 'required|string',
      'first_image' => 'required|image|mimes:jpeg,png,jpg',
      'tags' => 'nullable|string',
      // 'status' => 'required|in:draft,published',
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try {
      $article = new Article();
      if ($request->hasFile('first_image')) {
        $image = $request->file('first_image');
        $imageName = time() . '_' . $image->getClientOriginalName(); // Generate unique image name
        $image->move(public_path('assets/img/photos/articles/'), $imageName);
        $article->image = $imageName;
      }

      $article->title = $request->title;
      $article->content = $request->content;
      // $article->status = $request->status;
      $article->disease_id = $request->disease;
      $article->type_id = $request->type;
      // $article->user_id = Auth::user()->id;
      $article->tags = Article::TagsToString(json_decode($request->tags, true));
      $article->save();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Created Successfully."),
        'id' => $article->id
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
      'article_id' => 'required|string',
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
        $image->move(public_path('assets/img/photos/articles/'), $imageName);

        $newPhoto = new ArticlePhoto();
        $newPhoto->article_id = $request->article_id;
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

  public function unuploadPhotos(Request $request,$id) {
      try {
        $photo = ArticlePhoto::find($id);

        $filePath = public_path('assets/img/photos/articles/') . $photo->image;

        if (file_exists($filePath)) {
          unlink($filePath);
        }

        $photo->delete();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Deleted Successfully.")
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
      'title' => 'required|string|max:255',
      'type' => 'required|string',
      'disease' => 'required|string',
      'content' => 'required|string',
      'first_image' => 'sometimes|image|mimes:jpeg,png,jpg',
      'tags' => 'nullable|string',
      // 'status' => 'required|in:draft,published',
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try {
      $article = Article::find($request->id);
      if ($request->hasFile('first_image')) {
        $image = $request->file('first_image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('assets/img/photos/articles/'), $imageName);
        $article->image = $imageName;
      }

      $article->title = $request->title;
      $article->content = $request->content;
      // $article->status = $request->status;
      $article->type_id = $request->type;
      $article->disease_id = $request->disease;
      // $article->user_id = Auth::user()->id;
      $article->tags = Article::TagsToString(json_decode($request->tags, true));
      $article->save();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Updated Successfully."),
        'id' => $article->id
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $e->getMessage(),
      ]);
    }

  }

  public function delete($id) {
      $article = Article::find($id);
      $article->delete();
      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Deleted Successfully.")
      ]);
  }

  // public function comment(Request $request) {

  //   $comment = new ArticleComment();
  //   $comment->content = $request->content;
  //   $comment->profile_id = Auth::user()->profile->id;
  //   $comment->article_id = $request->article_id;
  //   $comment->save();

  //   $comment->photo = Auth::user()->profile->photoUrl();
  //   $comment->fullname = Auth::user()->profile->fullname;
  //   return response()->json([
  //     'icon' => 'success',
  //     'state' => __("Success"),
  //     'message' => __("Commented Successfully."),
  //     'comment' => $comment
  //   ]);
  // }

}
