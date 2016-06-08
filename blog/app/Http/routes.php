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




Route::get('/', function () {?>
<!DOCTYPE html>
<html>
    <head>
        <title>Video YOUTUBE Latest</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="http://freetuts.net/public/javascript/jquery.min.js" ></script>
        <script language="javascript">
            $(document).ready(function()
            {
                var chanel_id = 'UCg9QhTft6SFstWk67JlJiEA';
                var api_key  = 'AIzaSyBdJxvaeQKFaQoqcc36mJmqTv_J_BMCMFE';
                 
                // Get Youtube Video Upload ID
                $.get("https://www.googleapis.com/youtube/v3/channels", {
                        part : "contentDetails",
                        id : chanel_id,
                        key : api_key
                    },
                    function(data)
                    {
                        $.each(data.items, function(i, item)
                        {
                            // Upload ID
                            var id = item.contentDetails.relatedPlaylists.uploads;
 
                            $.get("https://www.googleapis.com/youtube/v3/playlistItems", {
                                    part : "snippet",
                                    maxResults : "50",
                                    playlistId  : id,
                                    key : api_key
                                },
                                function(result){
                                    var output = '';
                                    $.each(result.items, function(i, result_item){
                                        output += '<div>';
                                            var title = result_item.snippet.title;
                                            var href = result_item.snippet.resourceId.videoId;
                                            var img = result_item.snippet.thumbnails.default.url;
                                            output += '<img src="'+img+'" />';
                                            output += '<div><a href="https://www.youtube.com/watch?v='+href+'" title="'+title+'">'+title+'</a></div>';
                                        output +='</div>';
                                    });
                                    // Gán danh sách video vào body
                                    $('body').html(output);
                                }
                            );
                        });
                    }
                );
            });
        </script>
    </head>
    <body>
         
    </body>
</html><?php
});

Route::auth();
Route::get('/home', 'HomeController@index');
