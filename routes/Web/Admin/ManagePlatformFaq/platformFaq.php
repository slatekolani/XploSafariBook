<?php

Route::group([

    'namespace'=>'platformFaq',

] ,function () {

    Route::group([ 'prefix' => 'platformFaq',  'as' => 'platformFaq.'], function() {
        Route::get('/create', 'platformFaqController@create')->name('create');
        Route::post('/store', 'platformFaqController@store')->name('store');
        Route::get('/index', 'platformFaqController@index')->name('index');
        Route::get('/activatePlatformFAQ', 'platformFaqController@activatePlatformFAQ')->name('activatePlatformFAQ');
        Route::get('/getPlatformFaq', 'platformFaqController@getPlatformFaq')->name('getPlatformFaq');
        Route::get('/edit/{platformFaq}', 'platformFaqController@edit')->name('edit');
        Route::put('/update/{platformFaq}', 'platformFaqController@update')->name('update');
        Route::get('/delete/{platformFaq}', 'platformFaqController@destroy')->name('delete');
    });
});
