<?php

Route::group([

    'namespace'=>'Admin',

] ,function () {

    Route::group([ 'prefix' => 'tourType',  'as' => 'tourType.'], function() {
        Route::get('/spotLocalSafaris/{tourTypeUuid}', 'tourTypesController@spotLocalSafaris')->name('spotLocalSafaris');
    });




});
