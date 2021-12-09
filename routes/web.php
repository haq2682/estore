<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('index');
//});

Route::get('/', 'ProductController@index')->name('index');
Route::get('/search', 'ProductController@search')->name('products.search');
Route::get('/show/category/{id}', 'ProductController@show')->name('products.show');
Route::get('/details/{id}', 'ProductController@details')->name('products.details');
Route::get('/discounted', 'ProductController@discount')->name('products.discount');
Route::get('/shipping', 'Controller@shipping')->name('shipping');
Route::get('/returns', 'Controller@returns')->name('returns');
Route::get('/faq', 'Controller@faq')->name('faq');
Route::get('/policies', 'Controller@policies')->name('policies');
Route::get('/contact', 'Controller@contact')->name('contact');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function() {
    Route::get('/logout', function(){
       Auth::logout();
       return redirect('/login');
    });
    Route::post('/comments/store', 'CommentController@store')->name('comments.store');
    Route::delete('/comments/delete/{id}', 'CommentController@delete')->name('comments.delete');
    Route::get('/user/profile', 'UserController@profile')->name('user.profile');
    Route::put('/user/profile/updateInfo', 'UserController@updateInfo')->name('user.updateinfo');
    Route::put('/user/profile/updateavatar', 'UserController@updateAvatar')->name('user.updateavatar');
    Route::put('/user/profile/updatepassword', 'UserController@updatePassword')->name('user.updatepassword');
    Route::post('/user/profile/createaddress', 'UserController@createAddress')->name('user.createaddress');
    Route::put('/user/profile/updateaddress', 'UserController@updateAddress')->name('user.updateaddress');
    Route::post('/details/{id}/addwishlist', 'WishlistController@add')->name('products.details.addwishlist');
    Route::delete('/details/{id}/destroywishlist', 'WishlistController@destroy')->name('products.details.destroywishlist');
    Route::delete('/details/{id}/destroyorder', 'OrderController@destroy')->name('products.details.destroyorder');
    Route::get('/user/cart', 'CartController@show')->name('user.cart');
    Route::post('/user/cart/add', 'CartController@add')->name('user.cart.add');
    Route::delete('/user/cart/destroy', 'CartController@destroy')->name('user.cart.delete');
    Route::post('/user/cart/incrementqty', 'CartController@incrementQty')->name('user.cart.incrementqty');
    Route::post('/user/cart/decrementqty', 'CartController@decrementQty')->name('user.cart.decrementqty');
    Route::get('/checkout', 'CartController@showCheckout')->name('user.checkout');
    Route::post('/postcheckout', 'OrderController@checkout')->name('user.postcheckout');
    Route::get('/track', 'OrderController@track')->name('products.track');
    Route::get('/trackorder', 'OrderController@trackOrder')->name('products.trackorder');
});
Route::middleware('seller')->group(function() {
    Route::get('/seller/dashboard', 'SellerController@index')->name('seller.dashboard');
    Route::get('/seller/products', 'SellerController@products')->name('seller.products');
    Route::get('/seller/products/create', 'SellerController@create')->name('seller.create_product');
    Route::post('/seller/products/add', 'ProductController@add')->name('seller.add');
});
