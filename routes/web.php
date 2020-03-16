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
\Auth::routes();

######################## User Activities #####################################################################

//display only approved products
Route::get('/', 'UserController@viewProducts')->name('home');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

//logout function
Route::get('/logout', 'Auth\LoginController@logout');

// User views
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

####################################################################################################################
#
######################## Vendor Activities #########################################################################

//vendor signup page
Route::get('/vendor-signup', function () {
    return view('vendor-signup');
});
//Register Vendor
Route::post('/register/vendor', 'Auth\RegisterController@createVendor');

//Login vendor
Route::post('/login/vendor', 'Auth\LoginController@vendorLogin');

//view vendor dashboard
Route::get('/vendor', 'VendorController@index')->name('Dashboard')->middleware('auth.vendor');

//vendor upload products
Route::post('uploadProduct', 'VendorController@uploadProduct')->name('uploadProduct');

//vendor see products
Route::post('getProducts', 'VendorController@getProducts')->name('getProducts');

########################################################################################################################
                                                                                                                        #
######################## Admin Activities ###############################################################################
//vendor signup page
Route::get('/createAdmin', function () {
    return view('createAdmin');
});

//Register Admin
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');

//Admin Login
Route::post('/login/admin', 'Auth\LoginController@adminLogin');

//Admin dashboard and get pending products
Route::get('/admin', 'AdminController@adminPending')->name('admin')->middleware('auth.admin');

//Admin approve products
Route::get('/product/{action}/{id}', 'AdminController@adminAction')->name('action');

//Admin all products
Route::get('/admin-products', 'AdminController@adminAllProducts')->name('productss')->middleware('auth.admin');

####################################################################################################################






