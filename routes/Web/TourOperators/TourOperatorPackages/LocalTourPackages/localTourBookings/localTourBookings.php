<?php


Route::group([

    'namespace' => 'TourOperator\TourOperatorPackages\LocalTourPackages\localTourPackageBooking',

], function () {

    Route::group(['prefix' => 'localTourBooking', 'as' => 'localTourBooking.'], function () {
        Route::get('/index/{localTourPackageUuid}', 'localTourPackageBookingController@index')->name('index');
        Route::post('/store', 'localTourPackageBookingController@store')->name('store');
        Route::get('/edit/{localTourPackageBookingUuid}', 'localTourPackageBookingController@edit')->name('edit');
        Route::put('/update/{localTourPackageBookingUuid}', 'localTourPackageBookingController@update')->name('update');
        Route::get('/approvedLocalBookingsIndex/{localTourPackageUuid}', 'localTourPackageBookingController@approvedLocalBookingsIndex')->name('approvedLocalBookingsIndex');
        Route::get('/unapprovedLocalBookingIndex/{localTourPackageUuid}', 'localTourPackageBookingController@unapprovedLocalBookingIndex')->name('unapprovedLocalBookingIndex');
        Route::get('/deletedLocalBookingIndex/{localTourPackageUuid}', 'localTourPackageBookingController@deletedLocalBookingIndex')->name('deletedLocalBookingIndex');
        Route::get('/approveOrUnApproveBooking', 'localTourPackageBookingController@approveOrUnApproveBooking')->name('approveOrUnApproveBooking');
        Route::get('/getLocalTourBookings/{localTourPackageId}', 'localTourPackageBookingController@getLocalTourBookings')->name('getLocalTourBookings');
        Route::get('/getApprovedLocalTourBookings/{localTourPackageId}', 'localTourPackageBookingController@getApprovedLocalTourBookings')->name('getApprovedLocalTourBookings');
        Route::get('/getUnapprovedLocalTourBookings/{localTourPackageId}', 'localTourPackageBookingController@getUnapprovedLocalTourBookings')->name('getUnapprovedLocalTourBookings');
        Route::get('/getDeletedLocalTourBookings/{localTourPackageId}', 'localTourPackageBookingController@getDeletedLocalTourBookings')->name('getDeletedLocalTourBookings');
        Route::get('/destroy/{localTourBookingUuid}', 'localTourPackageBookingController@destroy')->name('delete');
        Route::get('/restore/{localTourBookingUuid}', 'localTourPackageBookingController@restore')->name('restore');
        Route::get('/forceDelete/{localTourBookingUuid}', 'localTourPackageBookingController@forceDelete')->name('forceDelete');
        Route::get('/show/{localTourBookingUuid}', 'localTourPackageBookingController@show')->name('view');
        Route::get('/viewDeleted/{localTourBookingUuid}', 'localTourPackageBookingController@viewDeleted')->name('viewDeleted');
        Route::get('/previewInvoice/{localTourPackageBookingUuid}', 'localTourPackageBookingController@previewInvoice')->name('previewInvoice');
        Route::get('/printInvoice/{localTourPackageBookingUuid}', 'localTourPackageBookingController@printInvoice')->name('printInvoice');
    });


});
