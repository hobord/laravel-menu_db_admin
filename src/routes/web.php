<?php

Route::group(['prefix' => 'admin/menu'], function () {

    Route::group(['prefix' => '/', 'middleware' => ['auth','permission:admin.menu.manage']], function () {
        Route::get('/', 'MenuDBAdminController@index')->name('admin.menu');
    });

});

