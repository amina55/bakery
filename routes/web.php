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

    Route::group(['namespace' => 'Store', 'middleware' => 'role:store_manager', 'prefix' => 'store'], function (){
        Route::resource('item', 'RawItemController');
        Route::resource('supplier', 'SupplierController');
        Route::resource('invoice', 'InvoiceController');

    });
});