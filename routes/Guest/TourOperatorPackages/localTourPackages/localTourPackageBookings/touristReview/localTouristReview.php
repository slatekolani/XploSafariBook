<?php


Route::group([

    'namespace' => 'TourOperator\TourOperatorPackages\LocalTourPackages\LocalTourPackageBooking\touristReviews',

], function () {

    Route::group(['prefix' => 'localTouristReview', 'as' => 'localTouristReview.'], function () {
        Route::get('/allLocalTouristReviews/{tourOperatorUuid}', 'localTouristReviewController@allLocalTouristReviews')->name('allLocalTouristReviews');
    });


});
