<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function add(Request $request) {
       $product = Product::find($request->details);
       Wishlist::create([
           'user_id' => auth()->user()->id,
           'product_id' => $product->id,
       ]);
       return back();
    }
    public function destroy(Request $request) {
        $wishlist = Wishlist::where('product_id', '=', $request->details)->first();
        $wishlist->delete();
        return back();
    }
}
