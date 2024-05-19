<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\PublicationComment;
use App\Models\PublicationPhoto;
use GuzzleHttp\Psr7\PumpStream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PublicationController extends Controller
{
  public function index() {
    $publications = Publication::where('status','published')->orderBy('created_at', 'desc')->take(15)->get();
    return view('content.home.publications.index')
    ->with('publications', $publications);
  }

  public function moreHome(Request $request) {
      $page = $request->get('page', 1);
      $perPage = 6;
      $publications = Publication::where('status', 'published')
                  ->orderBy('created_at', 'desc')
                  ->skip(($page - 1) * $perPage)
                  ->take($perPage)
                  ->get();

      $html = '';
      foreach ($publications as $publication) {
          $html .= view('components.publication', ['publication' => $publication])->render();
      }

      $hasMore = publication::where('status', 'published')->count() > $page * $perPage;

      return response()->json(['publications' => $publications->map(function($publication) {
          return [
              'id' => $publication->id,
              'html' => view('components.publication', ['publication' => $publication])->render(),
          ];
      }), 'hasMore' => $hasMore]);
  }

  public function ones($id) {
    $publication = Publication::find($id);
    $publication->view += 1;
    $publication->save();
    return view('content.home.publications.ones')
    ->with('publication', $publication);
  }

  public function get($id) {
    $publication = Publication::find($id);
    return view('content.dashboard.publications.index')
    ->with('publication',$publication);
  }

  public function create_index() {
    return view('content.dashboard.publications.create');
  }

  public function create(Request $request) {
    $validator = Validator::make($request->all(), [
      'title' => 'required|string|max:255',
      'content' => 'required|string',
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

      $publication = new Publication();
      $publication->user_id = Auth::user()->id;
      $publication->title = $request->title;
      $publication->content = $request->content;
      $publication->status = $request->status;
      $publication->tags = Publication::TagsToString(json_decode($request->tags, true));
      $publication->save();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Created Successfully."),
        'id' => $publication->id
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
      'publication_id' => 'required|string',
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
        $image->move(public_path('assets/img/photos/publications/'), $imageName);

        $newPhoto = new PublicationPhoto();
        $newPhoto->publication_id = $request->publication_id;
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
        $photo = PublicationPhoto::find($id);

        $filePath = public_path('assets/img/photos/publications/') . $photo->image;

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
      'content' => 'required|string',
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
      $publication = Publication::find($request->id);
      $publication->title = $request->title;
      $publication->content = $request->content;
      $publication->status = $request->status;
      $publication->user_id = Auth::user()->id;
      $publication->tags = Publication::TagsToString(json_decode($request->tags, true));
      $publication->save();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Updated Successfully."),
        'id' => $publication->id
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
      $publication = Publication::find($id);
      $publication->delete();
      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Deleted Successfully.")
      ]);
  }

  public function comment(Request $request) {

    $comment = new PublicationComment();
    $comment->content = $request->content;
    $comment->profile_id = Auth::user()->profile->id;
    $comment->publication_id = $request->publication_id;
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
