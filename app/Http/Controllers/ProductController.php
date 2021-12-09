<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index() {
        $products_recent= Product::orderBy('created_at', 'DESC')->limit(12)->get();
        $products_sales = Product::orderBy('sold', 'DESC')->limit(12)->get();
        $products_discount = Product::where('old_price', '>', 0)->limit(8)->get();
        return view('index', compact('products_recent', 'products_sales', 'products_discount'));
    }
    public function search(Request $request) {
        $term = $request->input('search');
        $products_search = Product::where('name', 'LIKE', '%'.$term.'%')->get();
        return view('products.search', compact('products_search'));
    }
    public function show(Request $request, $id) {
        $products = Product::where('category_id', '=', $id)->paginate(15);
        $category = Category::find($id);
       if($request->get('sort') == 'name') {
            $products = Product::where('category_id', '=', $id)->orderBy('name', 'ASC')->paginate(15);
        } elseif($request->get('sort') == 'price_low') {
            $products = Product::where('category_id', '=', $id)->orderBy('new_price', 'ASC')->paginate(15);
        } elseif($request->get('sort') == 'price_high') {
            $products = Product::where('category_id', '=', $id)->orderBy('new_price', 'DESC')->paginate(15);
        }
        else {
            $products = Product::where('category_id', '=', $id)->orderBy('name', 'ASC')->paginate(15);
        }
        return view('products.show', ['products'=>$products, 'category'=>$category]);
    }
    public function details($id) {
        $details = Product::find($id);
        $category_id = $details->category_id;
        $comments = Comment::all()->where('product_id', $id);
        $recommendations = Product::all()->random(10)->where('category_id', $category_id);
        if(Auth::check()) {
            $wishlist = Wishlist::where('product_id', '=', $id)->where('user_id', '=', auth()->user()->id)->first();
            $cart = Cart::where('user_id', '=', auth()->user()->id)->where('product_id', '=', $details->id)->first();
            return view('products.details', compact('details', 'recommendations', 'comments', 'wishlist', 'cart'));
        } else {
            return view('products.details', compact('details', 'recommendations', 'comments'));
        }
    }
    public function discount() {
        $products_discount = Product::where('old_price', '>', 0)->get();
        return view('products.discount', compact('products_discount'));
    }
    public function add(Request $request) {
        $inputs = $request->validate([
            'name' => 'required|regex:/^[\w\-\s]+$/',
            'overview' => 'required|min:100|max:255',
            'description' => 'required|min:300',
            'product_image1' => 'required|mimes:jpg,png,bmp',
//            'product_image2' => 'required|mimes:jpg,png,bmp',
//            'product_image3' => 'required|mimes:jpg,png,bmp',
//            'product_image4' => 'required|mimes:jpg,png,bmp',
//            'product_image5' => 'required|mimes:jpg,png,bmp',
            'count' => 'required',
            'new_price' => 'required',
            'old_price',
            'category_id' => 'required',
        ]);
        if(!$request->old_price) {
            $inputs['old_price'] = 0;
        }
        $path = public_path()."\images\products\\".auth()->user()->id;
        if(!$path) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        if(request('product_image1')) {
            $inputs['product_image1'] = request('product_image1')->store('images', 'public');
        }
        return [
            $inputs['name'],
            $inputs['overview'],
            $inputs['description'],
            $inputs['product_image1'],
            $inputs['count'],
            $inputs['new_price'],
//            $inputs['old_price'],
            $inputs['category_id'],
        ];
//        $inputs['product_image2'] = $request->product_image2->store('images/products/'. auth()->user()->id, 'public');
//        $inputs['product_image3'] = $request->product_image3->store('images/products/'. auth()->user()->id, 'public');
//        $inputs['product_image4'] = $request->product_image4->store('images/products/'. auth()->user()->id, 'public');
//        $inputs['product_image5'] = $request->product_image5->store('images/products/'. auth()->user()->id, 'public');
//        Product::create([
//           'user_id' => auth()->user()->id,
//           'stock_status' => 'instock',
//            'category_id' => $inputs['category_id'],
//            'name' => $inputs['name'],
//            'overview' => $inputs['overview'],
//            'description' => $inputs['description'],
//            'product_image1' => $inputs['product_image1'],
//            'product_image2' => $inputs['product_image2'],
//            'product_image3' => $inputs['product_image3'],
//            'product_image4' => $inputs['product_image4'],
//            'product_image5' => $inputs['product_image5'],
//            'count' => $inputs['count'],
//            'new_price' => $inputs['new_price'],
//            'old_price' => $inputs['old_price'],
//            'sold' => 0,
//        ]);
        auth()->user()->products()->create($inputs);
        session()->flash('message', 'Product created successfully!');
        return back();
    }
}