<?php

Route::group([

    'namespace'=>'tanzaniaRegions\regionCulture',

] ,function () {

    Route::group([ 'prefix' => 'regionCulture',  'as' => 'regionCulture.'], function() {
        Route::post('/store', 'tanzaniaRegionCultureController@store')->name('store');
        Route::get('/cultureCreate/{tanzaniaRegionUuid}', 'tanzaniaRegionCultureController@cultureCreate')->name('cultureCreate');
        Route::get('/index/{tanzaniaRegionUuid}', 'tanzaniaRegionCultureController@index')->name('index');
        Route::get('/getRegionCultures/{tanzaniaRegionUuid}', 'tanzaniaRegionCultureController@getRegionCultures')->name('getRegionCultures');
        Route::get('/show/{regionCultureUuid}', 'tanzaniaRegionCultureController@show')->name('view');
        Route::get('/edit/{regionCultureUuid}', 'tanzaniaRegionCultureController@edit')->name('edit');
        Route::get('/destroy/{regionCultureUuid}', 'tanzaniaRegionCultureController@destroy')->name('delete');
        Route::get('/deleteCharacteristic/{regionCultureCharacteristicUuid}', 'tanzaniaRegionCultureController@deleteCharacteristic')->name('deleteCharacteristic');
        Route::get('/deleteCultureChallenge/{regionCultureChallengeUuid}', 'tanzaniaRegionCultureController@deleteCultureChallenge')->name('deleteCultureChallenge');
        Route::get('/deleteAppreciationActivities/{appreciationActivitiesUuid}', 'tanzaniaRegionCultureController@deleteAppreciationActivities')->name('deleteAppreciationActivities');
        Route::put('/update/{regionCultureUuid}', 'tanzaniaRegionCultureController@update')->name('update');
    });




});
