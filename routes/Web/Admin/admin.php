<?php

Route::group([

    'namespace'=>'Admin',

] ,function () {

    Route::group([ 'prefix' => 'admin',  'as' => 'admin.'], function() {
        Route::get('/', 'AdminController@index')->name('index');
        Route::get('/system_menu', 'AdminController@systemMenu')->name('system_menu');
    });




});
