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
    Route::resource('/roles','RoleController');
    Route::resource('/products','ProductController');
    Route::resource('/employees','EmployeeController');
    //Route::resource('/clients','ClientController');
    Route::group(['prefix' =>'clients'],function (){
        Route::group(['middleware' => ['can:إضافة عميل'],'web'],function (){
            Route::get('/create','ClientController@create')->name('clients.create');
            Route::post('/store','ClientController@store')->name('clients.store');
            Route::post('/store/ajax','ClientController@ajaxStore')->name('clients.store.ajax');
        });
        Route::group(['middleware' => ['can:تعديل عميل']],function (){
            Route::get('/edit/{client}','ClientController@edit')->name('clients.edit');
            Route::post('/update/{client}','ClientController@update')->name('clients.update');
        });
        Route::group(['middleware' => ['can:حذف عميل']], function () {
            Route::delete('/destroy/{client}','ClientController@destroy')->name('clients.destroy');
        });
        Route::get('/','ClientController@index')->name('clients.index');
        Route::get('/show/{client}','ClientController@show')->name('clients.show');
        Route::group(['middleware' => ['can:البحث عن عملاء']], function () {
            Route::get('/search','ClientController@viewSearch')->name('clients.view.search');
            Route::post('/search','ClientController@search')->name('clients.search');
        });
    });
    Route::group(['prefix' =>'categories'],function(){
        Route::group(['middleware' => ['can:أضافة قسم']], function () {
            Route::get('/create','CategoryController@create')->name('categories.create');
            Route::post('/store','CategoryController@store')->name('categories.store');
        });
        Route::group(['middleware' => ['can:تعديل قسم']], function () {
            Route::get('/edit/{category}','CategoryController@edit')->name('categories.edit');
            Route::put('/update/{category}','CategoryController@update')->name('categories.update');
        });
        Route::group(['middleware' => ['can:حذف القسم']], function () {
            Route::delete('/destroy/{category}','CategoryController@destroy')->name('categories.destroy');
        });
        Route::get('/','CategoryController@index')->name('categories.index');
        Route::get('/show/{category}','CategoryController@show')->name('categories.show');
    });
    Route::group(['prefix' =>'subcategories'],function(){
        Route::group(['middleware' => ['can:أضافة قسم']], function () {
            Route::get('/create','SubcategoryController@create')->name('subcategories.create');
            Route::post('/store','SubcategoryController@store')->name('subcategories.store');
        });
        Route::group(['middleware' => ['can:تعديل قسم']], function () {
            Route::get('/edit/{subcategory}','SubcategoryController@edit')->name('subcategories.edit');
            Route::put('/update/{subcategory}','SubcategoryController@update')->name('subcategories.update');
        });
        Route::group(['middleware' => ['can:حذف القسم']], function () {
            Route::delete('/destroy/{subcategory}','SubcategoryController@destroy')->name('subcategories.destroy');
        });
        Route::get('/','SubcategoryController@index')->name('subcategories.index');
        Route::get('/show/{subcategory}','SubcategoryController@show')->name('subcategories.show');
    });
    Route::group(['prefix' =>'settings'],function(){
        Route::group(['middleware' => ['can:إضافة إعدادات']], function () {
            Route::get('/create','SettingController@create')->name('settings.create');
            Route::post('/store','SettingController@store')->name('settings.store');
        });
        Route::group(['middleware' => ['can:تعديل إعدادات']], function () {
            Route::get('/edit/{setting}','SettingController@edit')->name('settings.edit');
            Route::put('/update/{setting}','SettingController@update')->name('settings.update');
        });
        Route::group(['middleware' => ['can:حذف إعدادات']], function () {
            Route::delete('/destroy/{setting}','SettingController@destroy')->name('settings.destroy');
        });
        Route::get('/','SettingController@index')->name('settings.index');
        Route::get('/show/{setting}','SettingController@show')->name('settings.show');
    });
    Route::group(['prefix' =>'materials'],function(){
        Route::group(['middleware' => ['can:إضافة مواد خام']], function () {
            Route::get('/create','MaterialController@create')->name('materials.create');
            Route::post('/store','MaterialController@store')->name('materials.store');
        });
        Route::group(['middleware' => ['can:تعديل مواد خام']], function () {
            Route::get('/edit/{material}','MaterialController@edit')->name('materials.edit');
            Route::put('/update/{material}','MaterialController@update')->name('materials.update');
        });
        Route::group(['middleware' => ['can:حذف مواد خام']], function () {
            Route::delete('/destroy/{material}','MaterialController@destroy')->name('materials.destroy');
        });
        Route::get('/','MaterialController@index')->name('materials.index');
        Route::get('/show/{material}','MaterialController@show')->name('materials.show');
    });
    Route::group(['prefix' =>'supplies'],function(){
        Route::group(['middleware' => ['can:إضافة توريد للمخزن']], function () {
            Route::get('/create','SupplyController@create')->name('supplies.create');
            Route::post('/store','SupplyController@store')->name('supplies.store');
        });
        Route::group(['middleware' => ['can:تعديل توريد للمخزن']], function () {
            Route::get('/edit/{supply}','SupplyController@edit')->name('supplies.edit');
            Route::put('/update/{supply}','SupplyController@update')->name('supplies.update');
        });
        Route::group(['middleware' => ['can:حذف توريد للمخزن']], function () {
            Route::delete('/destroy/{supply}','SupplyController@destroy')->name('supplies.destroy');
        });
        Route::get('/','SupplyController@index')->name('supplies.index');
        Route::get('/show/{supply}','SupplyController@show')->name('supplies.show');
    });
    Route::group(['prefix' =>'productmanufactures'],function(){
        Route::group(['middleware' => ['can:إضافة تصنيع منتج']], function () {
            Route::get('/create','ProductManufactureController@create')->name('productmanufactures.create');
            Route::post('/store','ProductManufactureController@store')->name('productmanufactures.store');
        });
        Route::group(['middleware' => ['can:تعديل تصنيع منتج']], function () {
            Route::get('/edit/{productmanufacture}','ProductManufactureController@edit')->name('productmanufactures.edit');
            Route::put('/update/{productmanufacture}','ProductManufactureController@update')->name('productmanufactures.update');
        });
        Route::group(['middleware' => ['can:حذف تصنيع المنتج']], function () {
            Route::delete('/destroy/{productmanufacture}','ProductManufactureController@destroy')->name('productmanufactures.destroy');
        });
        Route::get('/','ProductManufactureController@index')->name('productmanufactures.index');
        Route::get('/show/{productmanufacture}','ProductManufactureController@show')->name('productmanufactures.show');
        Route::post('/materialselectto/{product_id?}','ProductManufactureController@material_select2_ajax')->name('productmanufactures.selectto');
    });
    Route::group(['prefix' =>'kitchenrequests'],function(){
        Route::group(['middleware' => ['can:إضافة طلبية من المطبخ']], function () {
            Route::get('/create','KitchenRequestController@create')->name('kitchenrequests.create');
            Route::post('/store','KitchenRequestController@store')->name('kitchenrequests.store');
        });
        Route::group(['middleware' => ['can:تعديل طلبية من المطبخ']], function () {
            Route::get('/edit/{kitchenrequest}','KitchenRequestController@edit')->name('kitchenrequests.edit');
            Route::put('/update/{kitchenrequest}','KitchenRequestController@update')->name('kitchenrequests.update');
        });
        Route::group(['middleware' => ['can:حذف طلبية من المطبخ']], function () {
            Route::delete('/destroy/{kitchenrequest}','KitchenRequestController@destroy')->name('kitchenrequests.destroy');
        });
        Route::get('/','KitchenRequestController@index')->name('kitchenrequests.index');
        Route::get('/show/{kitchenrequest}','KitchenRequestController@show')->name('kitchenrequests.show');
    });
    Route::group(['prefix' =>'damagedmaterials'],function(){
        Route::group(['middleware' => ['can:إضافة تلفيات']], function () {
            Route::get('/create','DamagedMaterialController@create')->name('damagedmaterials.create');
            Route::post('/store','DamagedMaterialController@store')->name('damagedmaterials.store');
        });
        Route::group(['middleware' => ['can:تعديل تلفيات']], function () {
            Route::get('/edit/{damagedmaterial}','DamagedMaterialController@edit')->name('damagedmaterials.edit');
            Route::put('/update/{damagedmaterial}','DamagedMaterialController@update')->name('damagedmaterials.update');
        });
        Route::group(['middleware' => ['can:حذف تلفيات']], function () {
            Route::delete('/destroy/{damagedmaterial}','DamagedMaterialController@destroy')->name('damagedmaterials.destroy');
        });
        Route::get('/','DamagedMaterialController@index')->name('damagedmaterials.index');
        Route::get('/show/{damagedmaterial}','DamagedMaterialController@show')->name('damagedmaterials.show');
    });
    Route::group(['middleware' => ['can:عرض رصيد المخزن']], function () {
        Route::get('/warehousestock','WarehouseStockController@index')->name('warehousestock.index');
    });
    // Route::resource('/employees','EmployeeController');

    // orders
    Route::get('/orders/status/{order}/{state}','OrderController@status')->name('orders.status');
    Route::delete('/destroy/{order}','OrderController@destroy')->name('orders.destroy');
    Route::group(['prefix' =>'orders'],function(){
        Route::group(['middleware' => ['can:إضافة طلب']], function () {
            Route::get('/create','OrderController@create')->name('orders.create');
            Route::post('/store','OrderController@store')->name('orders.store');
        });
        Route::group(['middleware' => ['can:تعديل طلب']], function () {
            Route::get('/edit/{order}','OrderController@edit')->name('orders.edit');
            Route::put('/update/{order}','OrderController@update')->name('orders.update');
        });
        Route::group(['middleware' => ['can:إلغاء طلب']], function () {
            Route::post('/orders/cancel/{order}','OrderController@cancel')->name('orders.cancel');

        });
        Route::get('/','OrderController@index')->name('orders.index');
        Route::get('/show/{order}','OrderController@show')->name('orders.show');
    });

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
