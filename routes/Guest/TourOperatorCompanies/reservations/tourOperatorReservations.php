<?php

Route::group([

    'namespace'=>'TourOperator\reservations',

] ,function () {

    Route::group([ 'prefix' => 'tourOperatorReservation',  'as' => 'tourOperatorReservation.'], function() {
        Route::get('/allReservations', 'tourOperatorReservationsController@allReservations')->name('allReservations');
    });




});
