<?php

Route::group([

    'namespace'=>'tourPackageType',

] ,function () {

    Route::group([ 'prefix' => 'tourPackageType',  'as' => 'tourPackageType.'], function() {
        Route::get('/spotLocalSafaris/{tourPackageTypeUuid}', 'tourPackageTypeController@spotLocalSafaris')->name('spotLocalSafaris');
    });




});
