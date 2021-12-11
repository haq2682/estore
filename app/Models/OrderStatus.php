<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderstatus extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function orders() {
        return $this->hasMany('App\Models\Order');
    }
    public function getStatusAttribute($value) {
        return ucwords($value);
    }
}
