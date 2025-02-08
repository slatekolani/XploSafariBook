<?php

Route::group([

    'namespace'=>'Admin',

] ,function () {

    Route::group([ 'prefix' => 'specialNeed',  'as' => 'specialNeed.'], function() {
        Route::post('/store', 'specialNeedController@store')->name('store');
        Route::get('/create', 'specialNeedController@create')->name('create');
        Route::get('/index', 'specialNeedController@index')->name('index');
        Route::get('/activateSpecialNeed', 'specialNeedController@activateSpecialNeed')->name('activateSpecialNeed');
        Route::get('/getSpecialNeeds', 'specialNeedController@getSpecialNeeds')->name('getSpecialNeeds');
        Route::get('/delete/{specialNeed}', 'specialNeedController@destroy')->name('delete');
        Route::get('/edit/{specialNeed}', 'specialNeedController@edit')->name('edit');
        Route::put('/update/{specialNeed}', 'specialNeedController@update')->name('update');
    });




});
