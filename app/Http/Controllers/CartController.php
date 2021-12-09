<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function show() {
        $user = Auth::user();
        $carts = Cart::where('user_id', '=', $user->id)->get();
        $sum = Cart::where('user_id', '=', $user->id)->sum('subtotal');
        return view('user.cart', compact('user', 'carts', 'sum'));
    }
    public function add(Request $request) {
        $user = Auth::user();
        $product = json_decode($request->product);
        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'subtotal' => $product->new_price,
        ]);
        session()->flash('message', 'Product added to cart successfully.');
        return back();
    }
    public function destroy(Request $request) {
        $id = $request->cart;
        $cart = Cart::find($id);
        $cart->delete();
        return back();
    }
    public function incrementQty(Request $request) {
        $item = Cart::find($request->quantity);
        $product_price = $item->product->new_price;
        $item->increment('quantity', 1);
        $item->increment('subtotal', $product_price);
        return back();
    }
    public function decrementQty(Request $request) {
        $item = Cart::find($request->quantity);
        $product_price = $item->product->new_price;
        $item->decrement('quantity', 1);
        $item->decrement('subtotal', $product_price);
        return back();
    }
    public function showCheckout() {
        $carts = Cart::where('user_id', '=', auth()->user()->id)->get();
        $sum = Cart::where('user_id', '=', auth()->user()->id)->sum('subtotal');
        $address = Address::where('user_id', '=', auth()->user()->id)->first();
        return view('user.checkout', compact('carts', 'sum', 'address'));
    }
}
