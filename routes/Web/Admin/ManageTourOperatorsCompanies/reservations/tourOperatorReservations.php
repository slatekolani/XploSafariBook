<?php

Route::group([

    'namespace'=>'TourOperator\reservations',

] ,function () {

    Route::group([ 'prefix' => 'tourOperatorReservation',  'as' => 'tourOperatorReservation.'], function() {
        Route::get('/create/{tourOperatorUuid}', 'tourOperatorReservationsController@create')->name('create');
        Route::get('/index/{tourOperatorUuid}', 'tourOperatorReservationsController@index')->name('index');
        Route::get('/approvedReservationIndex/{tourOperatorUuid}', 'tourOperatorReservationsController@approvedReservationIndex')->name('approvedReservationIndex');
        Route::get('/unapprovedReservationIndex/{tourOperatorUuid}', 'tourOperatorReservationsController@unapprovedReservationIndex')->name('unapprovedReservationIndex');
        Route::get('/deletedReservationIndex/{tourOperatorUuid}', 'tourOperatorReservationsController@deletedReservationIndex')->name('deletedReservationIndex');
        Route::get('/getTourCompanyReservations/{tourOperatorUuid}', 'tourOperatorReservationsController@getTourCompanyReservations')->name('getTourCompanyReservations');
        Route::get('/getApprovedReservations/{tourOperatorUuid}', 'tourOperatorReservationsController@getApprovedReservations')->name('getApprovedReservations');
        Route::get('/getUnapprovedReservations/{tourOperatorUuid}', 'tourOperatorReservationsController@getUnapprovedReservations')->name('getUnapprovedReservations');
        Route::get('/getDeletedReservations/{tourOperatorUuid}', 'tourOperatorReservationsController@getDeletedReservations')->name('getDeletedReservations');
        Route::get('/activateTourCompanyReservation', 'tourOperatorReservationsController@activateTourCompanyReservation')->name('activateTourCompanyReservation');
        Route::get('/show/{tourOperatorReservationUuid}', 'tourOperatorReservationsController@show')->name('view');
        Route::get('/viewDeletedReservation/{tourOperatorReservationUuid}', 'tourOperatorReservationsController@viewDeletedReservation')->name('viewDeletedReservation');
        Route::get('/edit/{tourOperatorReservationUuid}', 'tourOperatorReservationsController@edit')->name('edit');
        Route::get('/destroy/{tourOperatorReservationUuid}', 'tourOperatorReservationsController@destroy')->name('delete');
        Route::get('/deleteReservationFacility/{reservationFacilityUuid}', 'tourOperatorReservationsController@deleteReservationFacility')->name('deleteReservationFacility');
        Route::get('/deletePermanently/{reservationUuid}', 'tourOperatorReservationsController@deletePermanently')->name('deletePermanently');
        Route::get('/restoreDeletedReservation/{reservationUuid}', 'tourOperatorReservationsController@restoreDeletedReservation')->name('restoreDeletedReservation');
        Route::post('/store', 'tourOperatorReservationsController@store')->name('store');
        Route::put('/update/{tourOperatorReservationUuid}', 'tourOperatorReservationsController@update')->name('update');
    });




});
