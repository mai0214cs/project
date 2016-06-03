<?php
Route::group(['prefix'=>'admin', 'middleware'=>'auth'],function(){
    Route::get('/','AdminController@index');
    Route::group(['prefix'=>'news'],function(){
        Route::resource('category','News\NewsCategoryController');
        Route::resource('list','News\NewsListController');
        
    });
    Route::group(['prefix'=>'product'],function(){
        Route::resource('category','Product\ProductCategoryController');
        Route::resource('list','Product\ProductListController');
        Route::resource('attribute','Product\ProductAttributeController');
    });
    Route::group(['prefix'=>'order'],function(){
        Route::resource('customer','Order\CustomerController');
        Route::resource('invoice','Order\InvoiceController');
        Route::resource('order','Order\OrderController');
        Route::resource('payment','Order\PaymentController');
        Route::resource('shipment','Order\ShipmentController');
        Route::resource('promotion','Order\PromotionController');
    });
});


Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::get('/home', 'HomeController@index');
