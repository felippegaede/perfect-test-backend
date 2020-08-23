<?php

use Illuminate\Support\Facades\Route;



/*
Telas para ver o funcionamento sem dados
*/

Route::get('/', 'HomeController@index')->name('home');

Route::get('/products/create', 'ProductController@create')->name('product.create');
Route::post('/products/store', 'ProductController@store')->name('product.store');
Route::get('/products/{product}/edit', 'ProductController@edit')->name('product.edit');
Route::put('/products/{product}', 'ProductController@update')->name('product.update');
Route::delete('/products/{product}', 'ProductController@destroy')->name('product.destroy');
Route::post('/products/image/remove', 'ProductController@imageRemove')->name('products.image.remove');

Route::get('/customers/create', 'CustomerController@create')->name('customer.create');
Route::post('/customers/store', 'CustomerController@store')->name('customer.store');
Route::get('/customers/{customer}/edit', 'CustomerController@edit')->name('customer.edit');
Route::put('/customers/{customer}', 'CustomerController@update')->name('customer.update');

Route::get('/sales/create', 'SaleController@create')->name('sale.create');
Route::post('/sales/store', 'SaleController@store')->name('sale.store');
Route::get('/sales/{sale}/edit', 'SaleController@edit')->name('sale.edit');
Route::put('/sales/{sale}', 'SaleController@update')->name('sale.update');
Route::delete('/sales/{sale}', 'SaleController@destroy')->name('sale.destroy');


