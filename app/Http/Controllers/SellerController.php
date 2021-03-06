<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\Sale;
use App\Models\SellerRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SellerController extends Controller
{
    public function __construct() {
        $this->middleware('seller');
    }
    public function index()
    {
        if (!Gate::allows('seller-dashboard')) {
            abort(403);
        }
            $sold = [];
            $total = [];
// Circle trough all 12 months
            for ($month = 1; $month <= 12; $month++) {
                // Create a Carbon object from the current year and the current month (equals 2019-01-01 00:00:00)
                $date = Carbon::create(date('Y'), $month);
                // Make a copy of the start date and move to the end of the month (e.g. 2019-01-31 23:59:59)
                $date_end = $date->copy()->endOfMonth();
                $transaksi = Sale::where('user_id', auth()->user()->id)
                    // the creation date must be between the start of the month and the end of the month
                    ->where('created_at', '>=', $date)
                    ->where('created_at', '<=', $date_end)
                    // ->Where('status','!=','Menunggu')
                    ->sum('quantity');
                // Save the count of transactions for the current month in the output array
                $sold[$month] = (int)$transaksi;
                $transaksi2 = Sale::where('user_id', auth()->user()->id)
                    ->where('created_at', '>=', $date)
                    ->where('created_at', '<=', $date_end)
                    ->sum('total');
                $total[$month] = (int)$transaksi2;
                $products = Sale::where('user_id', '=', auth()->user()->id)->limit(10)->get();
                $sum = Sale::where('user_id', '=', auth()->user()->id)->sum('total');
                $items_sold = Sale::where('user_id', '=', auth()->user()->id)->count();
                $orders = Order::where('seller_id', '=', auth()->user()->id)->get();
            }
            return view('seller.dashboard', compact('sold', 'total', 'products', 'sum', 'items_sold', 'orders'));
    }
    public function products() {
        if (!Gate::allows('seller-dashboard')) {
            abort(403);
        }
        $products = Product::where('user_id', '=', auth()->user()->id)->get();
        return view('seller.products', compact('products'));
    }
    public function create() {
        if (!Gate::allows('seller-dashboard')) {
            abort(403);
        }
        $categories = Category::all();
        return view('seller.create_product', compact('categories'));
    }
    public function edit($id) {
        if (!Gate::allows('seller-dashboard')) {
            abort(403);
        }
        $item = Product::find($id);
        return view('seller.edit_product', $item);
    }
    public function solditems() {
        if (!Gate::allows('seller-dashboard')) {
            abort(403);
        }
        $orders = Order::where('seller_id', '=', auth()->user()->id)->where('orderstatus_id', '=', 4)->get();
        return view('seller.solditems', compact('orders'));
    }
    public function notifications() {
        if (!Gate::allows('seller-dashboard')) {
            abort(403);
        }
        return view('seller.notifications');
    }
    public function clearAllNotifications() {
        if (!Gate::allows('seller-dashboard')) {
            abort(403);
        }
        auth()->user()->notifications->each->truncate();
        return back();
    }
    public function showRequests() {
        if (!Gate::allows('seller-dashboard')) {
            abort(403);
        }
        $requests = SellerRequest::all();
        return view('seller.requests', compact('requests'));
    }
    public function grant($id) {
        if (!Gate::allows('seller-dashboard')) {
            abort(403);
        }
        $user = User::find($id);
        if($user->userHasRole('seller')) {
            return false;
        }
        else {
            $seller_role = Role::find(1);
            $user->roles()->attach($seller_role);
            SellerRequest::where('user_id', '=', $id)->delete();
            return back();
        }
    }
    public function deleteRequest($id) {
        $request = SellerRequest::find($id);
        $request->delete();
        return back();
    }
}
