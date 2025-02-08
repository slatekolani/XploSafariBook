<?php


Route::group([

    'namespace' => 'aboutTanzania\tanzaniaVisitAdvice',

], function () {

    Route::group(['prefix' => 'tanzaniaVisitAdvice', 'as' => 'tanzaniaVisitAdvice.'], function () {
        Route::get('create/{nation}', 'tanzaniaVisitAdviceController@create')->name('create');
        Route::get('index/{nationUuid}', 'tanzaniaVisitAdviceController@index')->name('index');
        Route::get('edit/{tanzaniaVisitAdviceUuid}', 'tanzaniaVisitAdviceController@edit')->name('edit');
        Route::get('getTanzaniaVisitAdvices/{nationUuid}', 'tanzaniaVisitAdviceController@getTanzaniaVisitAdvices')->name('getTanzaniaVisitAdvices');
        Route::get('show/{tanzaniaVisitAdviceUuid}', 'tanzaniaVisitAdviceController@show')->name('show');
        Route::get('destroy/{tanzaniaVisitAdviceUuid}', 'tanzaniaVisitAdviceController@destroy')->name('delete');
        Route::post('store', 'tanzaniaVisitAdviceController@store')->name('store');
        Route::put('update/{tanzaniaVisitAdviceUuid}', 'tanzaniaVisitAdviceController@update')->name('update');
    });


});
