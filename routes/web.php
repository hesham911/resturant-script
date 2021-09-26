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
Route::get('x',function (){
        \App\User::workFormUserId();
});

ROute::group([
    'prefix' =>'dashbord',
    'middleware'=>'is_admin'
],function (){
    Route::get('/', function () {return view('admin.dashboard');})->name('dashboard');
    Route::resource('/zones','ZoneController');
    Route::resource('/roles','RoleController');
    Route::resource('/products','ProductController');
    Route::group(['prefix' =>'employees'],function (){
        Route::get('/','EmployeeController@index')->name('indirect.costs.index');

        Route::group(['middleware' => ['can:إضافة مستخدم']],function (){
            Route::get('/create','EmployeeController@create')->name('employees.create');
            Route::post('/store','EmployeeController@store')->name('employees.store');
        });
        Route::group(['middleware' => ['can:تعديل مستخدم']],function (){
            Route::get('/edit/{employee}','EmployeeController@edit')->name('employees.edit');
            Route::put('/update/{employee}','EmployeeController@update')->name('employees.update');
        });
        Route::group(['middleware' => ['can:حذف مستخدم']],function (){
            Route::delete('/destroy/{employee}','EmployeeController@destroy')->name('employees.destroy');
        });
        Route::group(['middleware' => ['can:عرض مستخدم']],function (){
            Route::get('/','EmployeeController@index')->name('employees.index');
        });
    });
    Route::group(['prefix' =>'indirect-costs'],function (){
        Route::get('/','IndirectCostController@index')->name('indirect.costs.index');

        Route::group(['middleware' => ['can:إضافة تكاليف غير مباشرة']],function (){
            Route::get('/create','IndirectCostController@create')->name('indirect.costs.create');
            Route::post('/store','IndirectCostController@store')->name('indirect.costs.store');
        });
        Route::group(['middleware' => ['can:تعديل تكاليف غير مباشرة']],function (){
            Route::get('/edit/{indirectCost}','IndirectCostController@edit')->name('indirect.costs.edit');
            Route::put('/update/{indirectCost}','IndirectCostController@update')->name('indirect.costs.update');
        });
        Route::group(['middleware' => ['can:حذف تكاليف غير مباشرة']],function (){
            Route::delete('/destroy/{indirectCost}','IndirectCostController@destroy')->name('indirect.costs.destroy');
        });

    });

    Route::group(['prefix' =>'banks'],function (){
        Route::get('/','BankController@index')->name('banks.index');
        Route::group(['middleware' => ['can:إضافة تكاليف غير مباشرة']],function (){
            Route::get('/create','BankController@create')->name('banks.create');
            Route::post('/store','BankController@store')->name('banks.store');
        });
        Route::group(['middleware' => ['can:تعديل تكاليف غير مباشرة']],function (){
            Route::get('/edit/{bank}','BankController@edit')->name('banks.edit');
            Route::put('/update/{bank}','BankController@update')->name('banks.update');
        });
        Route::group(['middleware' => ['can:حذف تكاليف غير مباشرة']],function (){
            Route::delete('/destroy/{bank}','BankController@destroy')->name('banks.destroy');
        });
    });

    Route::group(['prefix'=>'work-period'],function (){
        Route::group(['middleware'=>'can:بدأ الشيفت'],function (){
            Route::get('/start','WorkPeriodController@create')->name('start.work.view');
            Route::post('/start','WorkPeriodController@store')->name('start.work.store');
        });
        Route::group(['middleware'=>'can:إغلاق الشيفت'],function (){
            Route::get('/end/{workperiod}','WorkPeriodController@edit')->name('end.work.view');

            Route::put('/end/{workperiod}','WorkPeriodController@update')->name('end.work.update');
        });

    });

    Route::group(['prefix' =>'transactions'],function (){
        Route::get('/','BankTransactionController@index')->name('transactions.index');
        Route::group(['middleware' => ['can:إضافة تكاليف غير مباشرة']],function (){
            Route::get('/create','BankTransactionController@create')->name('transactions.create');
            Route::post('/store','BankTransactionController@store')->name('transactions.store');
        });
        Route::group(['middleware' => ['can:تعديل تكاليف غير مباشرة']],function (){
            Route::get('/edit/{transaction}','BankTransactionController@edit')->name('transactions.edit');
            Route::put('/update/{transaction}','BankTransactionController@update')->name('transactions.update');
        });
        Route::group(['middleware' => ['can:حذف تكاليف غير مباشرة']],function (){
            Route::delete('/destroy/{transaction}','BankTransactionController@destroy')->name('transactions.destroy');
        });
    });

    Route::group(['prefix' =>'indirect-expenses'],function (){
        Route::get('/','IndirectExpenseController@index')->name('indirect.expenses.index');

        Route::group(['middleware' => ['can:إضافة مصروفات غير مباشرة']],function (){
            Route::get('/create','IndirectExpenseController@create')->name('indirect.expenses.create');
            Route::post('/store','IndirectExpenseController@store')->name('indirect.expenses.store');
        });
        Route::group(['middleware' => ['can:تعديل مصروفات غير مباشرة']],function (){
            Route::get('/edit/{indirectExpense}','IndirectExpenseController@edit')->name('indirect.expenses.edit');
            Route::put('/update/{indirectExpense}','IndirectExpenseController@update')->name('indirect.expenses.update');
        });
        Route::group([],function (){
            Route::delete('/destroy/{indirectExpense}','IndirectExpenseController@destroy')->name('indirect.expenses.destroy');

        });
    });
    Route::group(['prefix' =>'clients'],function (){
        Route::group(['middleware' => ['can:إضافة عميل'],'web'],function (){
            Route::get('/create','ClientController@create')->name('clients.create');
            Route::post('/store','ClientController@store')->name('clients.store');
            Route::post('/store/ajax','ClientController@ajaxStore')->name('clients.store.ajax');
        });
        Route::group(['middleware' => ['can:تعديل عميل']],function (){
            Route::get('/edit/{client}','ClientController@edit')->name('clients.edit');
            Route::put('/update/{client}','ClientController@update')->name('clients.update');
            Route::put('/blacklist/{client}/add','ClientController@addToBlacklist')->name('clients.blacklist.add');
            Route::put('/blacklist/{client}/remove','ClientController@removeFromBlackList')->name('clients.blacklist.remove');
        });
        Route::group(['middleware' => ['can:حذف عميل']], function () {
            Route::delete('/destroy/{client}','ClientController@destroy')->name('clients.destroy');
        });
        Route::get('/','ClientController@index')->name('clients.index');
        Route::get('/getajax','ClientController@getAjax')->name('clients.getajax');
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

        Route::get('/filter','OrderController@filterData')->name('orders.filter');
        Route::get('/clientinfo','OrderController@clientinfo')->name('orders.clientinfo');
        Route::get('/printclient/{order}','OrderController@printclient')->name('orders.printclient');
        Route::get('/printkitchen/{order}','OrderController@printkitchen')->name('orders.printkitchen');

        Route::group(['middleware' => ['can:إضافة طلب']], function () {
            Route::get('/create/{client?}','OrderController@create')->name('orders.create');
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

    Route::group(['prefix'=>'reports'],function (){
        Route::group(['prefix' =>'warehouse'],function(){
            Route::get('/','WarehouseReportController@index')->name('reports.warehouse.index');
            Route::post('/data','WarehouseReportController@indexData')->name('reports.warehouse.index.data');
        });

        Route::group(['prefix' =>'warehouseout'],function(){
            Route::get('/','WarehouseOutReportController@index')->name('reports.warehouseout.index');
            Route::post('/data','WarehouseOutReportController@indexData')->name('reports.warehouseout.index.data');
        });

        Route::group(['prefix' =>'kitchenrequestout'],function(){
            Route::get('/','KitchenRequestOutReportController@index')->name('reports.kitchenrequestout.index');
            Route::post('/data','KitchenRequestOutReportController@indexData')->name('reports.kitchenrequestout.index.data');
        });

        Route::group(['prefix' =>'daily'],function(){
            Route::get('/income','ReportController@dailyIncome')->name('reports.dailyIncome.index');
            Route::get('/outcome','ReportController@dailyOutcome')->name('reports.dailyOutcome.index');
        });

        Route::group(['prefix' =>'sales'],function(){
            Route::get('/','SalesReportController@index')->name('reports.sales.index');
            Route::post('/data','SalesReportController@indexData')->name('reports.sales.index.data');
        });

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

