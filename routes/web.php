<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/thank-you', 'HomeController@thanx');

Route::resource("products", ProductsController::class);

Route::resource("cart", CartController::class);

Route::resource("order", OrderController::class);


//Route::resource('photo', 'PhotoController', ['except' => [
//    'create', 'store', 'update', 'destroy'
//]]);