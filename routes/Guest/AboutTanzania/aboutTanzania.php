<?php


Route::group([

    'namespace' => 'aboutTanzania',

], function () {

    Route::group(['prefix' => 'Tanzania', 'as' => 'Tanzania.'], function () {
        Route::get('show/{nation}', 'TanzaniaController@show')->name('show');
    });


});
