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





Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Route::group(['middleware' =>'auth' ], function () {

Route::middleware('user_is_admin')->group(function (){

    // Units
    Route::get('units', 'UnitController@index')->name('units');
    Route::post('units', 'UnitController@store');
    Route::delete('units', 'UnitController@delete');
    Route::put('units', 'UnitController@update');
    Route::get('search-units' , 'unitController@search')->name('search-units');



    // Categories
    Route::get('categories', 'CategoryController@index')->name('categories');
    Route::post('categories', 'CategoryController@store');
    Route::delete('categories', 'CategoryController@delete');
    Route::put('categories', 'CategoryController@update');
    Route::get('search-categories' , 'CategoryController@search')->name('search-categories');

    //Products
    Route::get('products', 'ProductController@index')->name('products');

    Route::get('new-product', 'ProductController@newProduct')->name('new-product');
    Route::post('new-product', 'ProductController@store');


    Route::get('update-product/{id}', 'ProductController@newProduct')->name('update-product');
    Route::put('update-product', 'ProductController@update');

    Route::delete('products/{id}', 'ProductController@delete');
    Route::get('search-products' , 'ProductControllerController@search')->name('search-categories');
    //Tags
    Route::get('tags', 'TagController@index')->name('tags');
    Route::post('tags' , 'TagController@store');
    Route::delete('tags', 'TagController@delete');
    Route::put('tags', 'TagController@update');
    Route::get('search-tags' , 'TagController@search')->name('search-Tags');

    //Payments
    Route::get('payments', 'PaymentController@index')->name('payments');
    //Orders
    Route::get('order', 'OrderController@index')->name('orders');
    //Shipments
    Route::get('shipments', 'ShipmentController@index')->name('shipments');


    // Countries
    Route::get('countries', 'CountryController@index')->name('countries');
    // Cities
    Route::get('cities', 'CityController@index')->name('cities');
    //States
    Route::get('states', 'StateController@index')->name('states');
    //Reviews
    Route::get('reviews', 'ReviewController@index')->name('reviews');
    //Tickets
    Route::get('tickets', 'TicketController@index')->name('tickets');

    //Roles

    Route::get('import-units', 'DataImportController@importUnits')->name('import-units');
});



Route::get('user-role', function () {
    $user = \App\User::find(1);
    return $user->roles;
});
//
Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');


