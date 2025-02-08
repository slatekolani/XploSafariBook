<?php

Route::group([

    'namespace'=>'tourInsuranceTypes',

] ,function () {

    Route::group([ 'prefix' => 'tourInsuranceType',  'as' => 'tourInsuranceType.'], function() {
        Route::get('/create', 'tourInsuranceTypesController@create')->name('create');
        Route::post('/store', 'tourInsuranceTypesController@store')->name('store');
        Route::get('/activateTourInsurance', 'tourInsuranceTypesController@activateTourInsurance')->name('activateTourInsurance');
        Route::get('/getTourInsuranceType', 'tourInsuranceTypesController@getTourInsuranceType')->name('getTourInsuranceType');
        Route::get('/index', 'tourInsuranceTypesController@index')->name('index');
        Route::get('/destroy/{tourInsuranceTypeUuid}', 'tourInsuranceTypesController@destroy')->name('delete');
        Route::get('/edit/{tourInsuranceTypeUuid}', 'tourInsuranceTypesController@edit')->name('edit');
        Route::put('/update/{tourInsuranceTypeUuid}', 'tourInsuranceTypesController@update')->name('update');
        Route::get('/show/{tourInsuranceTypeUuid}', 'tourInsuranceTypesController@show')->name('view');

    });




});
