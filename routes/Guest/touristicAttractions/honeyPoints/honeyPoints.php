<?php

Route::group([

    'namespace'=>'TouristicAttraction\touristicAttractionHoneyPoints',

] ,function () {

    Route::group([ 'prefix' => 'touristicAttractionHoneyPoint',  'as' => 'touristicAttractionHoneyPoint.'], function() {
        Route::get('/publicView/{touristicAttractionUuid}', 'touristicAttractionHoneyPointsController@publicView')->name('publicView');
    });




});
