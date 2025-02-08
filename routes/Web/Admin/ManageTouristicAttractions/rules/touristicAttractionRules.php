<?php

Route::group([

    'namespace'=>'TouristicAttraction\touristicAttractionRules',

] ,function () {

    Route::group([ 'prefix' => 'touristicAttractionRule',  'as' => 'touristicAttractionRule.'], function() {
        Route::post('/store', 'touristicAttractionRulesController@store')->name('store');
        Route::get('/create/{nationUuid}', 'touristicAttractionRulesController@create')->name('create');
        Route::get('/getTouristicAttractionRule/{nationUuid}', 'touristicAttractionRulesController@getTouristicAttractionRule')->name('getTouristicAttractionRule');
        Route::get('/index/{nationUuid}', 'touristicAttractionRulesController@index')->name('index');
        Route::get('/show/{touristicAttractionUuid}', 'touristicAttractionRulesController@show')->name('view');
        Route::get('/edit/{touristicAttractionUuid}', 'touristicAttractionRulesController@edit')->name('edit');
        Route::get('/destroy/{touristicAttractionUuid}', 'touristicAttractionRulesController@destroy')->name('delete');
        Route::put('/update/{touristicAttractionUuid}', 'touristicAttractionRulesController@update')->name('update');
    });




});
