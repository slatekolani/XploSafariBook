<?php


Route::group([

    'namespace' => 'tourist\tripCancellation',

], function () {

    Route::group(['prefix' => 'localTripCancellation', 'as' => 'localTripCancellation.'], function () {
        Route::get('/create/{upcomingTripUuid}', 'localTourPackageCancelledBookingsController@create')->name('create');
        Route::post('/store', 'localTourPackageCancelledBookingsController@store')->name('store');
        Route::get('/activateOrDeactivateLocalTripCancelRequest', 'localTourPackageCancelledBookingsController@activateOrDeactivateLocalTripCancelRequest')->name('activateOrDeactivateLocalTripCancelRequest');
        Route::get('/index/{localTourPackageBookingUuid}', 'localTourPackageCancelledBookingsController@index')->name('index');
        Route::get('/approvedLocalTripCancelationRequestIndex/{localTourPackageBookingUuid}', 'localTourPackageCancelledBookingsController@approvedLocalTripCancelationRequestIndex')->name('approvedLocalTripCancelationRequestIndex');
        Route::get('/unapprovedLocalTripCancelationRequestIndex/{localTourPackageBookingUuid}', 'localTourPackageCancelledBookingsController@unapprovedLocalTripCancelationRequestIndex')->name('unapprovedLocalTripCancelationRequestIndex');
        Route::get('/deletedLocalTripCancelationRequestIndex/{localTourPackageBookingUuid}', 'localTourPackageCancelledBookingsController@deletedLocalTripCancelationRequestIndex')->name('deletedLocalTripCancelationRequestIndex');
        Route::get('/getLocalTourPackageCancellationRequests/{localTourPackageBooking}', 'localTourPackageCancelledBookingsController@getLocalTourPackageCancellationRequests')->name('getLocalTourPackageCancellationRequests');
        Route::get('/getUnapprovedLocalTourPackageCancellationRequests/{localTourPackageBooking}', 'localTourPackageCancelledBookingsController@getUnapprovedLocalTourPackageCancellationRequests')->name('getUnapprovedLocalTourPackageCancellationRequests');
        Route::get('/getApprovedLocalTourPackageCancellationRequests/{localTourPackageBooking}', 'localTourPackageCancelledBookingsController@getApprovedLocalTourPackageCancellationRequests')->name('getApprovedLocalTourPackageCancellationRequests');
        Route::get('/getDeletedLocalTourPackageCancellationRequests/{localTourPackageBooking}', 'localTourPackageCancelledBookingsController@getDeletedLocalTourPackageCancellationRequests')->name('getDeletedLocalTourPackageCancellationRequests');
        Route::get('/show/{localTripCancellationUuid}', 'localTourPackageCancelledBookingsController@show')->name('show');
        Route::get('/showDeletedCancellatioRequest/{localTripCancellationUuid}', 'localTourPackageCancelledBookingsController@showDeletedCancellatioRequest')->name('showDeletedCancellatioRequest');
        Route::get('/edit/{localTripCancellationUuid}', 'localTourPackageCancelledBookingsController@edit')->name('edit');
        Route::put('/update/{localTripCancellationUuid}', 'localTourPackageCancelledBookingsController@update')->name('update');
        Route::get('/destroy/{localTripCancellationUuid}', 'localTourPackageCancelledBookingsController@destroy')->name('delete');
        Route::get('/deletePermanently/{localTripCancellationUuid}', 'localTourPackageCancelledBookingsController@deletePermanently')->name('deletePermanently');
        Route::get('/restore/{localTripCancellationUuid}', 'localTourPackageCancelledBookingsController@restore')->name('restore');
    });


});
