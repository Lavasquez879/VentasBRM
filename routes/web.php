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



Auth::routes();

Route::resource('sales_invoice','SalesInvoiceController');

Route::get('/Sale_details', 'SalesInvoiceController@index')->name('home');

Route::get('/home', 'InventoryController@index')->name('home');

Route::resource('inventory','InventoryController');

Route::get('/', 'InventoryController@index')->name('Catalogue');

Route::post('inventory/create','InventoryController@create')->name('create');


Route::resource('product','ProductController');

Route::post('product/create', 'ProductController@create')->name('');


Route::resource('sale','SaleController');

Route::post('sale/create','SaleController@registerInvoice')->name('');




