<?php

Route::group(['prefix' => 'admin/menu/api'], function () {
    Route::get('/', 'MenuApiController@index');
    Route::get('/{menu_id}', 'MenuApiController@get');

    Route::group(['prefix' => '/', 'middleware' => ['auth','permission:admin.menu.manage']], function () {
        Route::post('/', 'MenuApiController@create');
        Route::post('/{menu_id}',  'MenuApiController@update');
        Route::get('/delete/{menu_id}',  'MenuApiController@delete');
    });
});

Route::group(['prefix' => 'admin/menu/item/api'], function () {
    Route::get('/list/{menu_id}', 'MenuItemApiController@index');
    Route::get('/{item_id}', 'MenuItemApiController@get');

    Route::group(['prefix' => '/', 'middleware' => ['auth','permission:admin.menu.manage']], function () {
        Route::post('/', 'MenuItemApiController@create');
        Route::post('/{item_id}',  'MenuItemApiController@update');
        Route::get('/delete/{item_id}',  'MenuItemApiController@delete');
    });
});

