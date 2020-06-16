<?php

use App\City;
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


Route::get('test_email' , function (){
    return 'Hello';
})->middleware(['auth' , 'email_verified']);
Route::get('states', function () {
    return \App\State::with(['country' , 'cities'])->paginate(1);
});


Route::get('countries', function () {
    return \App\Country::with(['cities' , 'states'])->paginate(1);
});

Route::get('cities', function () {
    return City::with(['state' , 'country'])->paginate(1);
});


Route::get('users', function () {
    return \App\User::paginate(15);
});

Route::get('products', function () {
    return \App\Product::with(['images'])->paginate(100);
});


Route::get('images', function () {
    return \App\Image::paginate(100);
});


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
