<?php


Route::group([

    'namespace' => 'aboutTanzania\FAQ',

], function () {

    Route::group(['prefix' => 'tanzaniaFAQ', 'as' => 'tanzaniaFAQ.'], function () {
        Route::get('create/{nation}', 'tanzaniaFAQController@create')->name('create');
        Route::post('store', 'tanzaniaFAQController@store')->name('store');
        Route::get('getTanzaniaFAQ/{nationUuid}', 'tanzaniaFAQController@getTanzaniaFAQ')->name('getTanzaniaFAQ');
        Route::get('index/{nationUuid}', 'tanzaniaFAQController@index')->name('index');
        Route::get('show/{tanzaniaFAQUuid}', 'tanzaniaFAQController@show')->name('show');
        Route::get('edit/{tanzaniaFAQUuid}', 'tanzaniaFAQController@edit')->name('edit');
        Route::put('update/{tanzaniaFAQUuid}', 'tanzaniaFAQController@update')->name('update');
        Route::get('destroy/{tanzaniaFAQUuid}', 'tanzaniaFAQController@destroy')->name('delete');
    });


});
