<?php

Route::group([

    'namespace'=>'tourPackageType',

] ,function () {

    Route::group([ 'prefix' => 'tourPackageType',  'as' => 'tourPackageType.'], function() {
        Route::post('/store', 'tourPackageTypeController@store')->name('store');
        Route::get('/create', 'tourPackageTypeController@create')->name('create');
        Route::get('/getTourPackageTypes', 'tourPackageTypeController@getTourPackageTypes')->name('getTourPackageTypes');
        Route::get('/index', 'tourPackageTypeController@index')->name('index');
        Route::get('/activateTourPackageType', 'tourPackageTypeController@activateTourPackageType')->name('activateTourPackageType');
        Route::get('/show/{tourPackageType}', 'tourPackageTypeController@show')->name('view');
        Route::get('/edit/{tourPackageType}', 'tourPackageTypeController@edit')->name('edit');
        Route::put('/update/{tourPackageType}', 'tourPackageTypeController@update')->name('update');
        Route::get('/destroy/{tourPackageType}', 'tourPackageTypeController@destroy')->name('delete');
    });




});
