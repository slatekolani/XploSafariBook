<?php

Route::group([

    'namespace'=>'TouristicAttraction\category',

] ,function () {

    Route::group([ 'prefix' => 'touristicAttractionCategory',  'as' => 'touristicAttractionCategory.'], function() {
        Route::get('/publicView/{attractionCategoryUuid}', 'touristicAttractionCategoryController@publicView')->name('publicView');
    });
});
