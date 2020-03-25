<?php

use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;
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
    return view('home');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/products', 'ProductsController');
Route::resource('/suppliers', 'SuppliersController');
Route::resource('/customers', 'CustomersController');
Route::resource('/purchaseorders', 'PurchaseOrdersController');
Route::resource('/addtoorder', 'AddToOrderController');
Route::resource('/purchaseordernumber', 'PurchaseNumberController');
Route::resource('/orderform', 'OrderFormController')->middleware('auth');
Route::resource('/getcustomerData', 'PurchaseCustomerController');
