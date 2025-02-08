<?php

Route::group([

    'namespace'=>'touristicActivities',

] ,function () {

    Route::group([ 'prefix' => 'touristicActivity',  'as' => 'touristicActivity.'], function() {
        Route::post('/store', 'touristicActivitiesController@store')->name('store');
        Route::get('/create', 'touristicActivitiesController@create')->name('create');
        Route::get('/index', 'touristicActivitiesController@index')->name('index');
        Route::get('/getTouristicActivity', 'touristicActivitiesController@getTouristicActivity')->name('getTouristicActivity');
        Route::get('/show/{touristicActivityUuid}', 'touristicActivitiesController@show')->name('show');
        Route::get('/edit/{touristicActivityUuid}', 'touristicActivitiesController@edit')->name('edit');
        Route::get('/delete/{touristicActivityUuid}', 'touristicActivitiesController@destroy')->name('delete');
        Route::get('/deleteTouristicActivityConductTip/{touristicActivityConductTipUuid}', 'touristicActivitiesController@deleteTouristicActivityConductTip')->name('deleteTouristicActivityConductTip');
        Route::put('/update/{touristicActivityUuid}', 'touristicActivitiesController@update')->name('update');
    });




});
