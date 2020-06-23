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


Route::get('import-units', 'DataImportController@importUnits')->name('import-units');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['auth', 'user_is_admin'], function () {

    // Units
    Route::get('units', 'UnitController@index')->name('units');
    Route::post('units', 'UnitController@store');
    Route::delete('units', 'UnitController@delete');
    Route::put('units', 'UnitController@update');



    // Categories
    Route::get('categories', 'CategoryController@index')->name('categories');
    //Products
    Route::get('products', 'ProductController@index')->name('products');
    //Tags
    Route::get('tags', 'TagController@index')->name('tags');

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


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
