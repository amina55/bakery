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

Route::get('/', function () {

    $view = 'auth.login';
    if(\Illuminate\Support\Facades\Auth::check()) {
       $view = 'home';
    }
    return view($view);
});

Auth::routes();

Route::get('test', 'TestController@index')->name('test.index');

Route::group(['middleware' => 'auth'], function (){

    Route::get('/home', 'HomeController@index');
    Route::get('user/profile', 'UserController@showProfile')->name('profile');


    Route::get('unit', 'UnitController@index')->name('unit.index');
    Route::post('unit', 'UnitController@store')->name('unit.store');
    Route::get('unit/destroy/{unit}', 'UnitController@destroy')->name('unit.destroy');


    /* ---- Store Management ----*/


    Route::group(['namespace' => 'Store', 'middleware' => 'role:store_manager', 'prefix' => 'store'], function (){


        Route::group(['prefix' => 'item'], function (){
            Route::get('destroy/{item}', 'RawItemController@destroy')->name('item.destroy');
        });
        Route::resource('item', 'RawItemController', ['except' => ['show', 'destroy']]);


        Route::group(['prefix' => 'supplier'], function (){
            Route::get('destroy/{supplier}', 'SupplierController@destroy')->name('supplier.destroy');
        });
        Route::resource('supplier', 'SupplierController', ['except' => ['show', 'destroy']]);


        Route::group(['prefix' => 'invoice'], function (){
            Route::get('destroy/{invoice}', 'InvoiceController@destroy')->name('invoice.destroy');
        });
        Route::resource('invoice', 'InvoiceController', ['except' => ['show', 'destroy']]);

    });


    /* ---- Kitchen Management ----*/


    Route::group(['namespace' => 'Kitchen', 'middleware' => 'role:kitchen_manager', 'prefix' => 'kitchen'], function (){

        /* ---- Stock ----*/

        Route::get('stock', 'StockController@index')->name('kitchen_stock.index');
        Route::post('add', 'StockController@addQuantity')->name('kitchen_stock.add_quantity');
        Route::post('stock', 'StockController@store')->name('kitchen_stock.store');
        Route::get('stock/destroy/{stock}', 'StockController@destroy')->name('kitchen_stock.destroy');


        /* ---- Kitchen's Request ----*/

        Route::get('request', 'RequestController@index')->name('kitchen_request.index');
        Route::post('request', 'RequestController@store')->name('kitchen_request.store');
        Route::get('request/destroy/{kitchen_request}', 'RequestController@destroy')->name('kitchen_request.destroy');


        /* ---- Bakery's Request ----*/

        Route::get('request', 'RequestController@listBakeryRequests')->name('bakery_req.list');
        Route::post('request', 'RequestController@approveBakeryRequest')->name('bakery_req.approve');
        Route::get('reject/{kitchen_request}', 'RequestController@rejectBakeryRequest')->name('bakery_req.reject');


    });


   /* ---- Bakery Management ----*/


    Route::group(['namespace' => 'Bakery', 'middleware' => 'role:bakery_manager', 'prefix' => 'bakery'], function (){

        /* ---- Category ----*/

        Route::get('category/destroy/{category}', 'CategoryController@destroy')->name('category.destroy');
        Route::resource('category', 'CategoryController', ['only' => ['index', 'store']]);

        /* ---- Category's Products ----*/

        Route::get('products/{category}', 'ProductController@index')->name('product.index');
        Route::post('products', 'ProductController@store')->name('product.store');
        Route::get('product/destroy/{product}', 'ProductController@destroy')->name('product.destroy');

        /* ---- Stock ----*/

        Route::get('stock', 'StockController@index')->name('bakery_stock.index');
        Route::post('stock', 'StockController@store')->name('bakery_stock.store');
        Route::get('stock/destroy/{stock}', 'StockController@destroy')->name('bakery_stock.destroy');

        /* ---- Bills ----*/

        Route::get('bill/destroy/{bill}', 'BillController@destroy')->name('bill.destroy');
        Route::resource('bill', 'BillController', ['except' => ['destroy']]);

        /* ---- Orders ----*/

        Route::get('order/destroy/{order}', 'OrderController@destroy')->name('order.destroy');
        Route::resource('order', 'OrderController', ['except' => ['destroy']]);

        /* ---- Bakery's Request ----*/

        Route::get('request', 'RequestController@index')->name('bakery_request.index');
        Route::post('request', 'RequestController@store')->name('bakery_request.store');
        Route::get('request/destroy/{bakery_request}', 'RequestController@destroy')->name('bakery_request.destroy');

    });
});