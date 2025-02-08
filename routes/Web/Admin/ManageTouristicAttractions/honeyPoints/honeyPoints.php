<?php

Route::group([

    'namespace'=>'TouristicAttraction\touristicAttractionHoneyPoints',

] ,function () {

    Route::group([ 'prefix' => 'touristicAttractionHoneyPoint',  'as' => 'touristicAttractionHoneyPoint.'], function() {
        Route::post('/store', 'touristicAttractionHoneyPointsController@store')->name('store');
        Route::get('/create/{touristicAttractionUuid}', 'touristicAttractionHoneyPointsController@create')->name('create');
        Route::get('/index/{touristicAttractionUuid}', 'touristicAttractionHoneyPointsController@index')->name('index');
        Route::get('/show/{honeyPointUuid}', 'touristicAttractionHoneyPointsController@show')->name('view');
        Route::get('/getHoneyPoints/{touristicAttractionUuid}', 'touristicAttractionHoneyPointsController@getHoneyPoints')->name('getHoneyPoints');
        Route::get('/edit/{honeyPointUuid}', 'touristicAttractionHoneyPointsController@edit')->name('edit');
        Route::get('/destroy/{honeyPointUuid}', 'touristicAttractionHoneyPointsController@destroy')->name('delete');
        Route::put('/update/{honeyPointUuid}', 'touristicAttractionHoneyPointsController@update')->name('update');
    });




});
