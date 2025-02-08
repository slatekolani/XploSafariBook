<?php


Route::group([

    'namespace' => 'TourOperator\customTourBookings',

], function () {

    Route::group(['prefix' => 'customTourBookings', 'as' => 'customTourBookings.'], function () {
        Route::get('/create/{tourOperator}', 'customTourBookingsController@create')->name('create');
        Route::post('/store', 'customTourBookingsController@store')->name('store');
    });


});
