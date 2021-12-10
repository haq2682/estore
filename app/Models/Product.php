<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
    public function carts() {
        return $this->hasMany('App\Models\Cart');
    }
    public function orders() {
        return $this->hasMany('App\Models\Order');
    }
    public function wishlists() {
        return $this->hasMany('App\Models\Wishlist');
    }
    public function sales() {
        return $this->hasMany('App\Models\Sale');
    }
}
