<?php

Route::group([

    'namespace'=>'Admin',

] ,function () {

    Route::group([ 'prefix' => 'tourType',  'as' => 'tourType.'], function() {
        Route::post('/store', 'tourTypesController@store')->name('store');
        Route::get('/create', 'tourTypesController@create')->name('create');
        Route::get('/index', 'tourTypesController@index')->name('index');
        Route::get('/activateTourType', 'tourTypesController@activateTourType')->name('activateTourType');
        Route::get('/getTourType', 'tourTypesController@getTourType')->name('getTourType');
        Route::get('/delete/{tourType}', 'tourTypesController@destroy')->name('delete');
        Route::get('/edit/{tourType}', 'tourTypesController@edit')->name('edit');
        Route::put('/update/{tourType}', 'tourTypesController@update')->name('update');
    });




});
