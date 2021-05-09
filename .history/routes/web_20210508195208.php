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


Route::get('/', function () {return view('admin.dashboard');})->name('dashboard');
// zones middleware('auth')->
Route::prefix('zones')->group(function()
{
    Route::get('/','ZoneController@index')->name('zones');
    Route::get('/create','ZoneController@create')->name('zones.create');
});


Route::resource('/zones','ZoneController');
Route::resource('/categories','CategoryController');
Route::resource('/subcategories','SubcategoryController');
Route::resource('/settings','SettingController');
Route::resource('/materials','MaterialController');
// orders
Route::resource('/orders','OrderController');
Route::post('/orders/cancel/{order}','OrderController@cancel')->name('orders.cancel');
Route::get('/orders/status/{order}/{state}','OrderController@status')->name('orders.status');
// products
Route::resource('/products','ProductController');


/* Route::get('orders', function () {
    return view('admin.orders');
})->name('orders'); */

Route::get('mail', function () {
    return view('mail');
})->name('mail');

// User
Route::get('users', function () {
    return view('admin.users');
})->name('users');

Route::get('profile', function () {
    return view('admin.profile');
})->name('profile');
Route::get('blank-page', function () {
    return view('admin.blank-page');
})->name('blank-page');
/*****/
// not found page
//Route::any('{catchall}',function(){return view('admin.partials.404');})->where('catchall', '.*');
/****/
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
