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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('/', 'AdminController@admin')->name('admin');
    Route::get('/products', 'AdminController@products')->name('products');

    Route::get('/loadProducts', 'AdminController@loadProducts');
    Route::post('/updateOrCreateProduct', 'AdminController@updateOrCreateProduct')->name('updateOrCreateProduct');
    Route::post('/searchProducts', 'AdminController@searchProducts')->name('searchProducts');

    Route::get('/loadOrders', 'AdminController@loadOrders');
    Route::post('/searchOrders', 'AdminController@searchOrders')->name('searchOrders');
});



Route::get('/loadProducts', 'HomeController@loadProducts');

Route::post('/saveOrder', 'HomeController@saveOrder')->name('saveOrder');



Auth::routes();

