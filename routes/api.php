<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//
//Route::middleware('auth:api')->get('/products', function (Request $request) {
//    return \App\Product::all();
//});

// Get Categories
Route::get('categories','Api\CategoryController@index');
Route::get('categories/{id}','Api\CategoryController@show');

// Get tags
Route::get('tags','Api\TagController@index');
Route::get('tags/{id}','Api\TagController@show');

// Get Products
Route::get('products','Api\ProductsController@index');
Route::get('products/{id}','Api\ProductsController@show');


// Get countries
Route::get('countries','Api\CountriesController@index');
Route::get('countries/{id}','Api\CountriesController@show');

Route::post('auth/register' , 'Api\AuthController@register');
Route::post('auth/login' , 'Api\AuthController@login');

Route::group(['auth:api'],  function (){

});
