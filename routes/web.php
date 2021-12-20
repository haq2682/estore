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
Auth::routes(['verify'=> true]);

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
Route::post('/category', 'CategoryController@add')->name('addcategory');
Route::post('/contact/message', 'Controller@sendMessage');



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'verified'])->group(function() {
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
    Route::get('/seller/request', 'UserController@sellerRequest');
});
Route::middleware(['auth', 'seller', 'verified'])->group(function() {
    Route::get('/seller/dashboard', 'SellerController@index')->name('seller.dashboard');
    Route::get('/seller/products', 'SellerController@products')->name('seller.products');
    Route::get('/seller/products/create', 'SellerController@create')->name('seller.create_product');
    Route::post('/seller/products/add', 'ProductController@add')->name('seller.add');
    Route::delete('/seller/products/delete/{id}', 'ProductController@delete')->name('seller.delete');
    Route::get('/seller/products/edit/{id}', 'ProductController@edit')->name('seller.edit_product');
    Route::put('/seller/products/update/{id}', 'ProductController@update')->name('seller.update');
    Route::get('/seller/orders', 'OrderController@show')->name('seller.orders');
    Route::get('/seller/orders/edit_status/{id}', 'OrderController@edit')->name('seller.edit_status');
    Route::put('/seller/orders/update_status/{id}', 'OrderController@updateStatus')->name('seller.update_status');
    Route::get('/seller/solditems', 'SellerController@solditems')->name('seller.solditems');
    Route::get('/markAsRead', function(){
       auth()->user()->unreadNotifications->markAsRead();
    });
    Route::get('/seller/notifications', 'SellerController@notifications')->name('seller.notifications');
    Route::get('/seller/notifications/clearall', 'SellerController@clearAllNotifications');
    Route::get('/seller/requests', 'SellerController@showRequests')->name('seller.requests');
    Route::post('/seller/grant_request/{id}', 'SellerController@grant')->name('seller.grant_request');
    Route::delete('/seller/delete_request/{id}', 'SellerController@deleteRequest')->name('seller.delete_request');
});
