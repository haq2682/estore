<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderstatus;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function destroy(Request $request) {
        $order = Order::where('product_id', '=', $request->details)->first();
        $order->delete();
        return back();
    }
    public function checkout() {
        $inputs = request()->validate([
            'address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
            'city' => 'required',
            'postal_code' => 'required',
            'province' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'credit-debit' => 'required',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required|min:3|max:3',
        ]);
        $carts = Cart::where('user_id', '=', auth()->user()->id)->get();
        $sum = Cart::where('user_id', '=', auth()->user()->id)->sum('subtotal');
        $address=$inputs['address'];
        $city = $inputs['city'];
        $postal_code = $inputs['postal_code'];
        $province = $inputs['province'];
        $country = $inputs['country'];
        $phone = $inputs['phone'];
        $orderno = auth()->user()->id . random_int(1000000, 9999999);
        foreach($carts as $cart) {
            $data = array(
                'address' => $address,
                'city' => $city,
                'postal_code' => $postal_code,
                'province' => $province,
                'country' => $country,
                'phone' => $phone,
                'orderno' => $orderno,
                'user_id' => auth()->user()->id,
                'seller_id' => $cart->product->user_id,
                'product_id' => $cart->product->id,
                'quantity' => $cart->quantity,
                'subtotal' => $cart->subtotal,
                'total' => $sum,
                'orderstatus_id' => 1,
            );
            Order::create($data);
            $item = Product::where('id', '=', $cart->product->id)->first();
            $item->decrement('count', $cart->quantity);
            $item->increment('sold', $cart->quantity);
            if($item->count === 0) {
                $item->stock_status = 'outofstock';
            }
            Sale::create([
                'user_id' => $cart->product->user->id,
                'product_id' => $cart->product->id,
                'quantity' => $cart->quantity,
                'sold_to' => auth()->user()->id,
                'total' => $sum,
            ]);
        }
        Cart::where('user_id', '=', auth()->user()->id)->truncate();
        return view('user.ordersuccess', compact('orderno'));
    }
    public function track() {
        return view('products.track');
    }
    public function trackOrder(Request $request) {
        $orderno = $request->orderno;
        $output = Order::where('user_id', '=', auth()->user()->id)->where('orderno', '=', $orderno)->first();
        if($output) {
            $number = $output->orderno;
            $status = $output->orderstatus->status;
            return view('products.trackorder', compact('status', 'number'));
        } else {
            return 'Order not found!';
        }
    }
    public function show() {
        $orders = Order::where('seller_id', '=', auth()->user()->id)->get();
        return view('seller.orders', compact('orders'));
    }
    public function edit($id) {
        $statuses = Orderstatus::all();
        $order = Order::find($id);
        return view('seller.edit_status', compact('order', 'statuses'));
    }
    public function updateStatus($id) {
        Order::where('id', '=', $id)->update([
            'orderstatus_id' => request('status'),
        ]);
        session()->flash('message', 'Order Status updated successfully!');
        return back();
    }
}
