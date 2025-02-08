<?php

Route::group([

    'namespace'=>'touristicActivities',

] ,function () {

    Route::group([ 'prefix' => 'touristicActivity',  'as' => 'touristicActivity.'], function() {
        Route::get('/showActivity/{touristicActivityUuid}', 'touristicActivitiesController@showActivity')->name('showActivity');
    });




});
