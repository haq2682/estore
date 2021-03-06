<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Notifications\CommentedOnProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        $comment = $request->comment;
        Comment::create([
            'comment' => $comment,
            'user_id' => Auth::id(),
            'product_id' => $product->id
        ]);
        $product->user->notify(new CommentedOnProduct($product, $comment));
        return back();
    }
    public function delete($id) {
        $comment = Comment::find($id);
        $comment->delete();
        return back();
    }
}
