<?php

Route::group([

    'namespace'=>'Admin',

] ,function () {

    Route::group([ 'prefix' => 'transport',  'as' => 'transport.'], function() {
        Route::post('/store', 'transportController@store')->name('store');
        Route::get('/create', 'transportController@create')->name('create');
        Route::get('/index', 'transportController@index')->name('index');
        Route::get('/activateTransport', 'transportController@activateTransport')->name('activateTransport');
        Route::get('/getTransports', 'transportController@getTransports')->name('getTransports');
        Route::get('/delete/{transport}', 'transportController@destroy')->name('delete');
        Route::get('/edit/{transport}', 'transportController@edit')->name('edit');
        Route::put('/update/{transport}', 'transportController@update')->name('update');
    });




});
