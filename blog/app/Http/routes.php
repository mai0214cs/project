<?php

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/', 'AdminController@index');
    Route::group(['prefix' => 'news'], function() {
        Route::resource('category', 'News\NewsCategoryController', ['only' => ['index', 'create', 'store', 'edit', 'update']]);
        Route::get('category/status/{id}', 'News\NewsCategoryController@status');
        Route::get('category/delete/{id}/{idnew}', 'News\NewsCategoryController@delete');
        Route::resource('list', 'News\NewsListController', ['only' => ['index', 'create', 'store', 'edit', 'update']]);
        Route::get('list/status/{type}/{id}', 'News\NewsListController@status');
        Route::get('list/delete/{id}', 'News\NewsListController@delete');
        Route::get('list/deleteall', 'News\NewsListController@deleteAll');
    });
    Route::group(['prefix' => 'product'], function() {
        Route::resource('category', 'Product\ProductCategoryController', ['only' => ['index', 'create', 'store', 'edit', 'update']]);
        Route::get('category/status/{id}', 'Product\ProductCategoryController@status');
        Route::get('category/delete/{id}/{idnew}', 'Product\ProductCategoryController@delete');
        Route::get('search', 'ProductListController@search');
        Route::get('list/delete/{id}', 'ProductListController@delete');
        Route::resource('list', 'Product\ProductListController');
        Route::get('list/status/{type}/{id}', 'Product\ProductListController@status');
        Route::resource('attributelist', 'Product\ProductAttributeListController');
        Route::resource('attributegroup', 'Product\ProductAttributeGroupController');
    });
    Route::group(['prefix' => 'order'], function() {
        Route::resource('customer', 'Order\CustomerController');
        Route::resource('invoice', 'Order\InvoiceController');
        Route::resource('order', 'Order\OrderController');
        Route::resource('payment', 'Order\PaymentController');
        Route::resource('shipment', 'Order\ShipmentController');
        Route::resource('promotion', 'Order\PromotionController');
    });
});


Route::resource('example', 'ExampleController');

Route::get('/', function () {
});

Route::auth();
Route::get('/home', 'HomeController@index');
