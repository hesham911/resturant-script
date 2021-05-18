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


ROute::group([
    'prefix' =>'dashbord',
    'middleware'=>'is_admin'
],function (){
    Route::get('/', function () {return view('admin.dashboard');})->name('dashboard');
    Route::resource('/zones','ZoneController');
    Route::resource('/employees','EmployeeController');
    Route::resource('/clients','ClientController');
    Route::resource('/categories','CategoryController');
    Route::resource('/subcategories','SubcategoryController');
    Route::resource('/settings','SettingController');
    Route::resource('/materials','MaterialController');
    Route::resource('/supplies','SupplyController');
    Route::resource('/productmanufactures','ProductManufactureController');
    Route::post('/productmanufactures/materialselectto/{product_id?}','ProductManufactureController@material_select2_ajax')->name('productmanufactures.selectto');
    Route::resource('/kitchenrequests','KitchenRequestController');
    Route::get('/warehousestock','WarehouseStockController@index')
    ->name('warehousestock.index');
    // Route::resource('/employees','EmployeeController');

    // orders
    Route::resource('/orders','OrderController');
    Route::post('/orders/cancel/{order}','OrderController@cancel')->name('orders.cancel');
    Route::get('/orders/status/{order}/{state}','OrderController@status')->name('orders.status');

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
});

Auth::routes([
    'register' => false,
]);
Route::get('/','HomeController@home');

