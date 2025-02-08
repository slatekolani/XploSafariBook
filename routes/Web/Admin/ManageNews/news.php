<?php

Route::group([

    'namespace'=>'news',

] ,function () {

    Route::group([ 'prefix' => 'news',  'as' => 'news.'], function() {
        Route::get('/create', 'newsController@create')->name('create');
        Route::post('/store', 'newsController@store')->name('store');
        Route::get('/activateNews', 'newsController@activateNews')->name('activateNews');
        Route::get('/getNews', 'newsController@getNews')->name('getNews');
        Route::get('/index', 'newsController@index')->name('index');
        Route::get('/edit/{news}', 'newsController@edit')->name('edit');
        Route::put('/update/{news}', 'newsController@update')->name('update');
        Route::get('/delete/{news}', 'newsController@destroy')->name('delete');
    });




});
