<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/products/{slug}', 'ProductController@get')->name('product.view');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::get('/cart/add/{slug}/{quantity}', 'CartController@add')->name('cart.add');
Route::post('/cart/update/{slug}', 'CartController@update')->name('cart.update');

Route::get('/cart/clear', function () {
	\Session::flush();
});