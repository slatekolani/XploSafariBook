<?php

Route::group([

    'namespace'=>'tanzaniaRegions',

] ,function () {

    Route::group([ 'prefix' => 'tanzaniaRegion',  'as' => 'tanzaniaRegion.'], function() {
        Route::get('/create', 'tanzaniaRegionsController@create')->name('create');
        Route::get('/index', 'tanzaniaRegionsController@index')->name('index');
        Route::post('/store', 'tanzaniaRegionsController@store')->name('store');
        Route::get('/getTanzaniaRegions', 'tanzaniaRegionsController@getTanzaniaRegions')->name('getTanzaniaRegions');
        Route::get('/activateTanzaniaRegion', 'tanzaniaRegionsController@activateTanzaniaRegion')->name('activateTanzaniaRegion');
        Route::get('/destroy/{tanzaniaRegionUuid}', 'tanzaniaRegionsController@destroy')->name('delete');
        Route::get('/edit/{tanzaniaRegionUuid}', 'tanzaniaRegionsController@edit')->name('edit');
        Route::put('/update/{tanzaniaRegionUuid}', 'tanzaniaRegionsController@update')->name('update');
        Route::get('/show/{tanzaniaRegionUuid}', 'tanzaniaRegionsController@show')->name('view');
        Route::get('/deleteRegionPrecaution/{tanzaniaRegionPrecautionUuid}', 'tanzaniaRegionsController@deleteRegionPrecaution')->name('deleteRegionPrecaution');
    });




});
