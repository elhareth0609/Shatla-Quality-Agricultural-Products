<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_Products;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nnjeim\World\World;

class CartController extends Controller
{
    public function index() {
      return view('content.home.carts.index');
    }

    public function checkout() {
      $countries =  World::countries();
      return view('content.home.carts.checkout')
      ->with('countries',$countries->data);
    }


    public function create(Request $request) {
      $product = Product::find($request->id);
      $product->photo = $product->firstPhoto();
      $state = false;
      $delete = null;
      if (!(Auth::user()->cart->myCart($request->id))) {
        $cart = new Cart_Products();
        $cart->product_id = $request->id;
        $cart->cart_id = Auth::user()->cart->id;
        $cart->quantity = 1;
        $cart->save();
        $state = true;
        $product->quantityPivot = $cart->quantity;
      } else {
        $cart =  Cart_Products::where('cart_id',Auth::user()->cart->id)
        ->where('product_id',$request->id)
        ->first();
        $cart->delete();
        $delete = $request->id;
      }
      $cartCount = Cart_Products::where('cart_id', Auth::user()->cart->id)->count();

      $product->photoUrl = $product->firstPhoto();

      return response()->json([
        'count' => $cartCount,
        'state' => $state,
        'data' => $product,
        'delete' => $delete
      ]);
    }

    public function update(Request $request) {
      $product = Product::find($request->id);
      // $product->photo = $product->firstPhoto();
      $state = false;
      $update = null;
      if (!(Auth::user()->cart->myCart($request->id))) {
        $cart = new Cart_Products();
        $cart->product_id = $request->id;
        $cart->cart_id = Auth::user()->cart->id;
        $cart->quantity = $request->quantity;
        $cart->save();
        $state = true;
        $product->quantityPivot = $cart->quantity;
      } else {
        $cart =  Cart_Products::where('cart_id',Auth::user()->cart->id)
        ->where('product_id',$request->id)
        ->first();
        $cart->quantity = $request->quantity;
        $cart->save();
        $update = $request->quantity;
      }
      $cartCount = Cart_Products::where('cart_id', Auth::user()->cart->id)->count();

      $product->photoUrl = $product->firstPhoto();

      return response()->json([
        'count' => $cartCount,
        'state' => $state,
        'data' => $product,
        'update' => $update
      ]);

    }

    public function delete(Request $request) {
      $cart =  Cart_Products::where('cart_id',Auth::user()->cart->id)
      ->where('product_id',$request->id)
      ->first();
      $cart->delete();
      $cartCount = Cart_Products::where('cart_id', Auth::user()->id)->count();
      return response()->json([
        'success' => true,
        'count' => $cartCount,
      ]);
    }

    public function update_quantity(Request $request) {
      $request->validate([
        'id' => 'required|exists:cart__products,product_id',
        'quantity' => 'required|integer|min:1',
      ]);

    $cart =  Cart_Products::where('cart_id',Auth::user()->cart->id)
    ->where('product_id',$request->id)
    ->first();

    $cart->update([
      'quantity' => $request->quantity,
    ]);

    return response()->json([
      'success' => true,
      'message' => 'Quantity updated successfully'
    ]);

    }
}
