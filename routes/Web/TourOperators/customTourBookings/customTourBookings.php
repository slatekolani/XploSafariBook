<?php


Route::group([

    'namespace' => 'TourOperator\customTourBookings',

], function () {

    Route::group(['prefix' => 'customTourBookings', 'as' => 'customTourBookings.'], function () {
        Route::get('/index/{tourOperator}', 'customTourBookingsController@index')->name('index');
        Route::get('/getCustomTourBookings/{tourOperator}', 'customTourBookingsController@getCustomTourBookings')->name('getCustomTourBookings');
        Route::get('/approveOrUnApproveBooking', 'customTourBookingsController@approveOrUnApproveBooking')->name('approveOrUnApproveBooking');
        Route::get('/delete/{customTourBooking}', 'customTourBookingsController@destroy')->name('delete');
        Route::get('/forceDeleteCustomBooking/{customTourBooking}', 'customTourBookingsController@forceDeleteCustomBooking')->name('forceDeleteCustomBooking');
        Route::get('/view/{customTourBooking}', 'customTourBookingsController@show')->name('view');
        Route::get('/viewDeleted/{customTourBooking}', 'customTourBookingsController@viewDeleted')->name('viewDeleted');
        Route::get('/edit/{customTourBooking}', 'customTourBookingsController@edit')->name('edit');
        Route::put('/update/{customTourBooking}', 'customTourBookingsController@update')->name('update');
        Route::get('/approvedCustomTourBookingsIndex/{tourOperator}', 'customTourBookingsController@approvedCustomTourBookingsIndex')->name('approvedCustomTourBookingsIndex');
        Route::get('/getApprovedCustomTourBookings/{tourOperator}', 'customTourBookingsController@getApprovedCustomTourBookings')->name('getApprovedCustomTourBookings');
        Route::get('/unApprovedCustomTourBookingsIndex/{tourOperator}', 'customTourBookingsController@unApprovedCustomTourBookingsIndex')->name('unApprovedCustomTourBookingsIndex');
        Route::get('/getUnApprovedCustomTourBookings/{tourOperator}', 'customTourBookingsController@getUnApprovedCustomTourBookings')->name('getUnApprovedCustomTourBookings');
        Route::get('/recentCustomTourBookingsIndex/{tourOperator}', 'customTourBookingsController@recentCustomTourBookingsIndex')->name('recentCustomTourBookingsIndex');
        Route::get('/getRecentCustomTourBookingsMade/{tourOperator}', 'customTourBookingsController@getRecentCustomTourBookingsMade')->name('getRecentCustomTourBookingsMade');
        Route::get('/nearCustomTourIndex/{tourOperator}', 'customTourBookingsController@nearCustomTourIndex')->name('nearCustomTourIndex');
        Route::get('/getNearCustomTours/{tourOperator}', 'customTourBookingsController@getNearCustomTours')->name('getNearCustomTours');
        Route::get('/expiredCustomTourBookingsIndex/{tourOperator}', 'customTourBookingsController@expiredCustomTourBookingsIndex')->name('expiredCustomTourBookingsIndex');
        Route::get('/getExpiredCustomTourBookings/{tourOperator}', 'customTourBookingsController@getExpiredCustomTourBookings')->name('getExpiredCustomTourBookings');
        Route::get('/getDeletedCustomTourBookings/{customTourBookingId}', 'customTourBookingsController@getDeletedCustomTourBookings')->name('getDeletedCustomTourBookings');
        Route::get('/DeletedCustomBookingsIndex/{tourOperator}', 'customTourBookingsController@DeletedCustomBookingsIndex')->name('DeletedCustomBookingsIndex');
        Route::get('/RestoreDeletedCustomBooking/{customTourBookingId}', 'customTourBookingsController@RestoreDeletedCustomBooking')->name('RestoreDeletedCustomBooking');
        Route::get('/invoicePreview/{customTourBookingUuid}', 'customTourBookingsController@invoicePreview')->name('invoicePreview');
        Route::get('/printInvoice/{customTourBookingUuid}', 'customTourBookingsController@printInvoice')->name('printInvoice');
        Route::get('/deleteAttractionReservation/{attractionReservationUuid}', 'customTourBookingsController@deleteAttractionReservation')->name('deleteAttractionReservation');
    });


});
