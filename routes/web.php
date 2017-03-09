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



/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', ['uses' => 'ProductController@getDataProducts', 'as' => 'list-products']);
Route::post('add-to-wishlist', ['uses' => 'ProductController@saveProduct', 'as' => 'add-item']);

Route::get('wish-list', ['uses' => 'WishListController@getWishList', 'as' => 'list-items']);
Route::get('delete-item-wish/{id}', ['uses' => 'WishListController@deleteItem', 'as' => 'delete-item']);

Auth::routes();

Route::get('/home', 'HomeController@index');
