<?php


Route::group([

    'namespace' => 'TourOperator\TourPackageBookings',

], function () {

    Route::group(['prefix' => 'tourPackageBookings', 'as' => 'tourPackageBookings.'], function () {
        Route::get('/create/{tourPackage}', 'TourPackageBookingsController@create')->name('create');
        Route::post('/store', 'TourPackageBookingsController@store')->name('store');

    });


});
