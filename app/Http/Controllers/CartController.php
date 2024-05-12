<?php

namespace App\Http\Controllers;

use App\Models\Adress;
use App\Models\Cart;
use App\Models\Cart_Products;
use App\Models\Coupon;
use App\Models\Details;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Product;
use Chargily\ePay\Chargily;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Nnjeim\World\World;

class CartController extends Controller
{
    public function index() {
      return view('content.home.carts.index');
    }

    public function checkout(Request $request) {
      $countries = World::countries();

      $coupon = Coupon::where('code',$request->coupon)->first();
      $cart = Auth::user()->cart;
      $products = $cart->products;

      return view('content.home.carts.checkout')
      ->with('coupon',$coupon)
      ->with('products',$products)
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


    public function order(Request $request) {
      $validator = Validator::make($request->all(), [
        'adress_id' => 'nullable|string',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone1' => 'required|string|max:255',
        'phone2' => 'nullable|string|max:255',
        'zip' => 'required|string|max:10',
        'country' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'address1' => 'required|string|max:255',
        'address2' => 'nullable|string|max:255',
        'city' => 'required|string|max:255',
      ]);

      if ($validator->fails()) {
          return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $validator->errors()->first()
          ], 422);
      }

      try {

        if (!$request->adress_id) {
          $address = new Adress();
          $address->user_id = Auth::user()->id;
          $address->first_name = $request->first_name;
          $address->last_name = $request->last_name;
          $address->phone1 = $request->phone1;
          $address->phone2 = $request->phone2;
          $address->zip = $request->zip;
          $address->country = $request->country;
          $address->state = $request->state;
          $address->address1 = $request->address1;
          $address->address2 = $request->address2;
          $address->city = $request->city;
          $address->save();
        }

        $coupon = Coupon::find($request->coupon_id);

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->coupon_id = $request->coupon_id;
        $order->payment_method = $request->payment_method;
        $order->shipping = $request->shipping;
        $order->save();

        $products = '';
        foreach(Auth::user()->cart->products as $cartProduct) {
          $orderProduct = new OrderProducts();
          $orderProduct->order_id = $order->id;
          $orderProduct->product_id = $cartProduct->product->id;
          $orderProduct->quantity = $cartProduct->quantity;
          $orderProduct->price = $cartProduct->product->price;
          $orderProduct->save();
          $products = $cartProduct->product->name . ',';
          $cartProduct->delete();
        }

        if ($request->payment_method == 'gold-card') {
          $chargilyConfig = config('chargily');

          $chargily = new Chargily([
              'api_key' => $chargilyConfig['key'],
              'api_secret' => $chargilyConfig['secret'],
              'urls' => [
                  'back_url' => 'https://example.com/chargily/payment/success',
                  'webhook_url' => 'https://example.com/chargily/payment/webhook',
              ],
              'mode' => 'EDAHABIA',
              'payment' => [
                  'number' => 'payment-number-from-your-side',
                  'client_name' => Auth::user()->profile->fullname,
                  'client_email' => Auth::user()->email,
              'amount' => (Auth::user()->cart->totalCart() * ($coupon ? $coupon->discount/100 : 1)) + Details::where('type', 'shipping')->first()->content,
              'discount' => 0,
              'description' => $products,
            ]
          ]);

          $redirectUrl = $chargily->getRedirectUrl();
        }

        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Created Successfully."),
          'payment_method' => $request->payment_method,
          'url' => $redirectUrl
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $e->getMessage(),
        ]);
      }

    }
}
