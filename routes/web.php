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
Route::resource('/products', 'Orders\ProductsController');
Route::resource('/suppliers', 'Orders\SuppliersController');
Route::resource('/customers', 'Orders\CustomersController');
Route::resource('/purchaseorders', 'Orders\PurchaseOrdersController');
Route::resource('/addtocart', 'Orders\AddToCartController');
Route::resource('/purchaseordernumber', 'Orders\PurchaseNumberController');
Route::resource('/orderform', 'Orders\OrderFormController')->middleware('auth');
Route::resource('/getcustomerData', 'Orders\PurchaseCustomerController');
//Route::resource('/purchaseproducts', 'PurchaseProductsController');
