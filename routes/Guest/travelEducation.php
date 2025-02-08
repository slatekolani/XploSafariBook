<?php

Route::group([

    'namespace'=>'TravelEducation',

] ,function () {

    Route::group([ 'prefix' => 'travelEducation',  'as' => 'travelEducation.'], function() {
        Route::get('/publicView', 'travelEducationController@publicView')->name('publicView');
    });




});
