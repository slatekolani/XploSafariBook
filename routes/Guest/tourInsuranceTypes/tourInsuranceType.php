<?php

Route::group([

    'namespace'=>'tourInsuranceTypes',

] ,function () {

    Route::group([ 'prefix' => 'tourInsuranceType',  'as' => 'tourInsuranceType.'], function() {
        Route::get('/spotTourOperator/{tourInsuranceTypeUuid}', 'tourInsuranceTypesController@spotTourOperator')->name('spotTourOperator');
    });




});
