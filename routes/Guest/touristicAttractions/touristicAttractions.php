<?php

Route::group([

    'namespace'=>'TouristicAttraction',

] ,function () {

    Route::group([ 'prefix' => 'touristicAttraction',  'as' => 'touristicAttraction.'], function() {
        Route::get('/show/{touristicAttraction}', 'touristicAttractionController@show')->name('show');
        Route::get('/spotTourOperator/{touristicAttractionUuid}', 'touristicAttractionController@spotTourOperator')->name('spotTourOperator');
    });




});
