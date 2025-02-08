<?php


Route::group([

    'namespace' => 'TourOperator\TourOperatorPackages\LocalTourPackages\LocalTourPackageBooking\touristReviews',

], function () {

    Route::group(['prefix' => 'localTouristReview', 'as' => 'localTouristReview.'], function () {
        Route::get('/create/{localTourBookingUuid}', 'localTouristReviewController@create')->name('review');
        Route::post('/store', 'localTouristReviewController@store')->name('store');
        Route::get('/index/{localTourBookingUuid}', 'localTouristReviewController@index')->name('index');
        Route::get('/getLocalTouristReviews/{localTourBookingUuid}', 'localTouristReviewController@getLocalTouristReviews')->name('getLocalTouristReviews');
        Route::get('/approvedLocalTouristReviewsIndex/{localTourBookingUuid}', 'localTouristReviewController@approvedLocalTouristReviewsIndex')->name('approvedLocalTouristReviewsIndex');
        Route::get('/getApprovedLocalTouristReview/{localTourBookingUuid}', 'localTouristReviewController@getApprovedLocalTouristReview')->name('getApprovedLocalTouristReview');
        Route::get('/unApprovedTouristReviewIndex/{localTourBookingUuid}', 'localTouristReviewController@unApprovedTouristReviewIndex')->name('unApprovedTouristReviewIndex');
        Route::get('/getUnapprovedLocalTouristReview/{localTourBookingUuid}', 'localTouristReviewController@getUnapprovedLocalTouristReview')->name('getUnapprovedLocalTouristReview');
        Route::get('/deletedTouristReviewIndex/{localTourBookingUuid}', 'localTouristReviewController@deletedTouristReviewIndex')->name('deletedTouristReviewIndex');
        Route::get('/getDeletedLocalTouristReview/{localTourBookingUuid}', 'localTouristReviewController@getDeletedLocalTouristReview')->name('getDeletedLocalTouristReview');
        Route::get('/approveOrUnApproveReview', 'localTouristReviewController@approveOrUnApproveReview')->name('approveOrUnApproveReview');
        Route::get('/destroy/{localTouristReviewUuid}', 'localTouristReviewController@destroy')->name('delete');
        Route::get('/restoreDeletedTouristReviews/{localTouristReviewUuid}', 'localTouristReviewController@restoreDeletedTouristReviews')->name('restoreDeletedTouristReviews');
        Route::get('/deletePermanentlyTouristReview/{localTouristReviewUuid}', 'localTouristReviewController@deletePermanentlyTouristReview')->name('deletePermanentlyTouristReview');
        Route::get('/show/{localTouristReviewUuid}', 'localTouristReviewController@show')->name('view');
        Route::get('/showDeletedTouristReview/{localTouristReviewUuid}', 'localTouristReviewController@showDeletedTouristReview')->name('showDeletedTouristReview');
    });


});
