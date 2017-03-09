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

// Default route
Route::get('/', ['uses' => 'ProductController@getDataProducts', 'as' => 'list-products']);

// Crawler route
Route::post('add-to-wishlist', ['uses' => 'ProductController@saveProduct', 'as' => 'add-item']);

// Wish List actions route
Route::get('wish-list', ['uses' => 'WishListController@getWishList', 'as' => 'list-items']);
Route::get('delete-item-wish/{id}', ['uses' => 'WishListController@deleteItem', 'as' => 'delete-item']);

// Update profile route
Route::get('update-profile', ['uses' => 'ProfileController@showProfile', 'as' => 'my-profile']);
Route::post('update-profile/{id}', ['uses' => 'ProfileController@updateProfile', 'as' => 'update-profile']);

// Scaffolding Auth
Auth::routes();

