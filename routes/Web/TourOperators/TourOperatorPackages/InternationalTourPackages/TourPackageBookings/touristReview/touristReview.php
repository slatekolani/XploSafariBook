<?php


Route::group([

    'namespace' => 'TourOperator\touristReview',

], function () {

    Route::group(['prefix' => 'touristReview', 'as' => 'touristReview.'], function () {
        Route::get('/index/{tourPackageBooking}', 'touristReviewsController@index')->name('index');
        Route::get('/getTouristReviews/{tourPackageBooking}', 'touristReviewsController@getTouristReviews')->name('getTouristReviews');
        Route::get('/approveOrUnApproveReview', 'touristReviewsController@approveOrUnApproveReview')->name('approveOrUnApproveReview');
        Route::get('/delete/{touristReview}', 'touristReviewsController@destroy')->name('delete');
        Route::get('/view/{touristReview}', 'touristReviewsController@show')->name('view');
        Route::get('/approvedTouristReviewsIndex/{tourPackageBooking}', 'touristReviewsController@approvedTouristReviewsIndex')->name('approvedTouristReviewsIndex');
        Route::get('/getApprovedTouristReviews/{tourPackageBooking}', 'touristReviewsController@getApprovedTouristReviews')->name('getApprovedTouristReviews');
        Route::get('/unApprovedTouristReviewIndex/{tourPackageBooking}', 'touristReviewsController@unApprovedTouristReviewIndex')->name('unApprovedTouristReviewIndex');
        Route::get('/getUnApprovedTouristReviews/{tourPackageBooking}', 'touristReviewsController@getUnApprovedTouristReviews')->name('getUnApprovedTouristReviews');
        Route::get('/deletedTouristReviewIndex/{tourPackageBooking}', 'touristReviewsController@deletedTouristReviewIndex')->name('deletedTouristReviewIndex');
        Route::get('/getDeletedTouristReviews/{tourPackageBooking}', 'touristReviewsController@getDeletedTouristReviews')->name('getDeletedTouristReviews');
        Route::get('/restoreDeletedTouristReviews/{touristReview}', 'touristReviewsController@restoreDeletedTouristReviews')->name('restoreDeletedTouristReviews');
    });


});
