<?php

Route::group([

    'namespace'=>'TourOperator\TourCompanyLocalToursGoals',

] ,function () {

    Route::group([ 'prefix' => 'tourCompanyLocalToursGoals',  'as' => 'tourCompanyLocalToursGoals.'], function() {
        Route::get('/create/{tourOperatorUuid}', 'tourCompanyLocalToursGoalsController@create')->name('create');
        Route::get('/index/{tourOperatorUuid}', 'tourCompanyLocalToursGoalsController@index')->name('index');
        Route::get('/edit/{tourOperatorLocalToursGoalsUuid}', 'tourCompanyLocalToursGoalsController@edit')->name('edit');
        Route::put('/update/{tourOperatorLocalToursGoalsUuid}', 'tourCompanyLocalToursGoalsController@update')->name('update');
        Route::get('/show/{tourOperatorLocalToursGoalsUuid}', 'tourCompanyLocalToursGoalsController@show')->name('show');
        Route::get('/getTourCompanyLocalTourGoals/{tourOperatorUuid}', 'tourCompanyLocalToursGoalsController@getTourCompanyLocalTourGoals')->name('getTourCompanyLocalTourGoals');
        Route::get('/deleteMonthBreakdown/{breakDownUuid}', 'tourCompanyLocalToursGoalsController@deleteMonthBreakdown')->name('deleteMonthBreakdown');
        Route::get('/deletePackageSegmentation/{segmentationUuid}', 'tourCompanyLocalToursGoalsController@deletePackageSegmentation')->name('deletePackageSegmentation');
        Route::post('/store', 'tourCompanyLocalToursGoalsController@store')->name('store');
    });
});
