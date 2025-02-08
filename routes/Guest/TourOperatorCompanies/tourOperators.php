<?php

Route::group([

    'namespace'=>'TourOperator',

] ,function () {

    Route::group([ 'prefix' => 'tourOperator',  'as' => 'tourOperator.'], function() {
        Route::get('/publicView/{tour_operator_company}', 'tourOperatorController@publicView')->name('publicView');
        Route::get('/allTourOperators', 'tourOperatorController@allTourOperators')->name('allTourOperators');
    });




});
