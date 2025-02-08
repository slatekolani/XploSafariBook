<?php

Route::group([

    'namespace'=>'tanzaniaAndWorldEvents',

] ,function () {

    Route::group([ 'prefix' => 'event',  'as' => 'event.'], function() {
        Route::get('create', 'tanzaniaAndWorldEventsController@create')->name('create');
        Route::post('store', 'tanzaniaAndWorldEventsController@store')->name('store');
        Route::get('index', 'tanzaniaAndWorldEventsController@index')->name('index');
        Route::get('activateEvent', 'tanzaniaAndWorldEventsController@activateEvent')->name('activateEvent');
        Route::get('getTanzaniaAndWorldEvents', 'tanzaniaAndWorldEventsController@getTanzaniaAndWorldEvents')->name('getTanzaniaAndWorldEvents');
        Route::get('destroy/{event}', 'tanzaniaAndWorldEventsController@destroy')->name('delete');
        Route::get('show/{event}', 'tanzaniaAndWorldEventsController@show')->name('view');
        Route::get('edit/{event}', 'tanzaniaAndWorldEventsController@edit')->name('edit');
        Route::put('update/{event}', 'tanzaniaAndWorldEventsController@update')->name('update');
    });




});
