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

Route::group(['middleware' => 'auth'], function (){

    Route::get('/home', 'HomeController@index');
    Route::get('user/profile', 'UserController@showProfile')->name('profile');


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

        Route::group(['prefix' => 'item'], function (){
            Route::get('destroy/{item}', 'RawItemController@destroy')->name('item.destroy');
        });
        Route::resource('item', 'RawItemController', ['except' => ['show', 'destroy']]);

    });


   /* ---- Bakery Management ----*/


    Route::group(['namespace' => 'Bakery', 'middleware' => 'role:bakery_manager', 'prefix' => 'bakery'], function (){

        Route::group(['prefix' => 'category'], function (){
            Route::get('destroy/{category}', 'CategoryController@destroy')->name('category.destroy');
        });
        Route::resource('category', 'CategoryController', ['only' => ['index', 'store']]);


        Route::group(['prefix' => 'product'], function (){
            Route::get('destroy/{product}', 'ProductController@destroy')->name('product.destroy');
        });
        Route::resource('product', 'ProductController', ['except' => ['show', 'destroy']]);

    });
});