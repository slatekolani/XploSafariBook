<?php

Route::group([

    'namespace'=>'tanzaniaRegions\tanzaniaRegionFAQ',

] ,function () {

    Route::group([ 'prefix' => 'tanzaniaRegionFAQ',  'as' => 'tanzaniaRegionFAQ.'], function() {
        Route::get('/create/{tanzaniaRegionUuid}', 'tanzaniaRegionFAQController@create')->name('create');
        Route::get('/index/{tanzaniaRegionUuid}', 'tanzaniaRegionFAQController@index')->name('index');
        Route::get('/getRegionFAQ/{tanzaniaRegionUuid}', 'tanzaniaRegionFAQController@getRegionFAQ')->name('getRegionFAQ');
        Route::post('/store', 'tanzaniaRegionFAQController@store')->name('store');
        Route::get('/show/{tanzaniaRegionFAQUuid}', 'tanzaniaRegionFAQController@show')->name('view');
        Route::get('/edit/{tanzaniaRegionFAQUuid}', 'tanzaniaRegionFAQController@edit')->name('edit');
        Route::get('/destroy/{tanzaniaRegionFAQUuid}', 'tanzaniaRegionFAQController@destroy')->name('delete');
        Route::put('/update/{tanzaniaRegionFAQUuid}', 'tanzaniaRegionFAQController@update')->name('update');
    });




});
