<?php

Route::group([

    'namespace'=>'tanzaniaRegions',

] ,function () {

    Route::group([ 'prefix' => 'tanzaniaRegion',  'as' => 'tanzaniaRegion.'], function() {
        Route::get('/publicView/{tanzaniaRegionUuid}', 'tanzaniaRegionsController@publicView')->name('publicView');
    });




});
