<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
  public function create(Request $request) {
    $product = Product::find($request->id);
    $product->photo = $product->firstPhoto();
    $state = false;
    $delete = null;
    if (!(Auth::user()->myFavorite($request->id))) {
      $favorite = new Favorite;
      $favorite->product_id = $request->id;
      $favorite->user_id = Auth::user()->id;
      $favorite->save();
      $state = true;
    } else {
      $favorite =  Favorite::where('user_id',Auth::user()->id)
      ->where('product_id',$request->id)
      ->first();
      $favorite->delete();
      $delete = $request->id;
    }
    $favoriteCount = Favorite::where('user_id', Auth::user()->id)->count();

    return response()->json([
      'count' => $favoriteCount,
      'state' => $state,
      'data' => $product,
      'delete' => $delete
    ]);

  }

  public function update(Request $request) {

  }

  public function delete(Request $request) {
    $favorite =  Favorite::where('user_id',Auth::user()->id)
    ->where('product_id',$request->id)
    ->first();
    $favorite->delete();

    $favoriteCount = Favorite::where('user_id', Auth::user()->id)->count();

    return response()->json([
      'success' => true,
      'count' => $favoriteCount
    ]);}

}
