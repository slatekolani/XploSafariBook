<?php


Route::group([

    'namespace' => 'tourist',

], function () {

    Route::group(['prefix' => 'tourist', 'as' => 'tourist.'], function () {
        Route::get('/userManual', 'touristController@userManual')->name('userManual');
        Route::get('/bookingsMadeByTourist', 'touristController@bookingsMadeByTourist')->name('bookingsMadeByTourist');
        Route::get('/destinationTravelledbyUser', 'touristController@destinationTravelledbyUser')->name('destinationTravelledbyUser');
    });


});
