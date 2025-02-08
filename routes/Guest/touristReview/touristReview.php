<?php


Route::group([

    'namespace' => 'TourOperator\touristReview',

], function () {

    Route::group(['prefix' => 'touristReview', 'as' => 'touristReview.'], function () {
        Route::get('/reviewTourOperator/{tourPackageBooking}', 'touristReviewsController@create')->name('reviewTourOperator');
        Route::get('/allTouristReviews/{tourOperatorId}', 'touristReviewsController@allTouristReviews')->name('allTouristReviews');
        Route::post('/store', 'touristReviewsController@store')->name('store');
    });


});
