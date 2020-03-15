<?php

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
if (App::environment('production')) {
    URL::forceScheme('https');
}

//views
Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/login', function () {
    return view('login');
});
Route::get('/cart', function () {
    return view('cart');
});
Route::get('/checkout', function () {
    return view('checkout');
});
Route::get('/shop', function () {
    return view('shop');
});
Route::get('/product-details', function () {
    return view('product-details');
});
Route::get('/blog', function () {
    return view('blog');
});
Route::get('/blog-single', function () {
    return view('blog-single');
});
Route::get('/404', function () {
    return view('404');
});
Route::get('/contactus', function () {
    return view('contactus');
});
Route::get('/vendor', function () {
    return view('vendor');
});


#### Vendor Activities ###
//vendor upload products
Route::post('uploadProduct', 'VendorController@uploadProduct')->name('uploadProduct');
//vendor see products
Route::post('getProducts', 'VendorController@getProducts')->name('getProducts');


#### Admin Activities ###
//Admin get pending products
Route::get('/admin', 'AdminController@adminPending')->name('admin');
//Admin approve products
Route::get('/product/{action}/{id}', 'AdminController@adminAction')->name('action');
