<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['comment', 'product_id', 'user_id'];
    public function products() {
        return $this->belongsToMany('App\Models\Product');
    }
    public function user() {
        return $this->belongsTo('App\Models\User',);
    }
}
