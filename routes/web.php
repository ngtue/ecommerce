<?php

use Gloudemans\Shoppingcart\Facades\Cart;

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('shop', 'ShopController@index')->name('shop.index');
Route::get('shop/{product}', 'ShopController@show')->name('shop.show');

Route::get('cart', 'CartController@index')->name('cart.index');
Route::post('cart', 'CartController@store')->name('cart.store');
Route::post('cart/save/{product}', 'CartController@save')->name('cart.save');
Route::delete('cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::patch('cart/{product}', 'CartController@update')->name('cart.update');


Route::delete('saveForLater/{product}', 'SaveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('saveForLater/moveToCart/{product}', 'SaveForLaterController@move')->name('saveForLater.move');

Route::get('checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('checkout', 'CheckoutController@store')->name('checkout.store');

Route::get('thankyou', 'ConfirmationController@index')->name('thankyou.index');

Route::post('coupon', 'CouponController@store')->name('coupon.store');
Route::delete('coupon', 'CouponController@destroy')->name('coupon.destroy');

Route::get('empty', function(){
    Cart::instance('defaul')->destroy();
});

