<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
//        $inputs = $request->validate([
//            'comment' => 'max:255',
//            'product_id' => $product->id,
//        ]);
//        auth()->user()->comments()->create($inputs);
//        return back();
//    }
        Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
            'product_id' => $product->id
        ]);
        return back();
    }
    public function delete($id) {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back();
    }
}
