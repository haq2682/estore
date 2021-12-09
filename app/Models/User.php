<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function products() {
        return $this->hasMany('App\Models\Product');
    }
    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }
    public function roles() {
        return $this->belongsToMany('App\Models\Role');
    }
    public function carts() {
        return $this->hasMany('App\Models\Cart');
    }
    public function address() {
        return $this->hasOne('App\Models\Address');
    }
    public function orders() {
        return $this->hasMany('App\Models\Order');
    }
    public function wishlists() {
        return $this->hasMany('App\Models\Wishlist');
    }
    public function userHasRole($role_name) {
        foreach($this->roles as $role) {
            if($role_name == $role->name) {
                return true;
            }
        }
        return false;
    }
    public function sales() {
        return $this->hasMany('App\Models\Sale');
    }
}
