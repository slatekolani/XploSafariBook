<?php

Route::group([

    'namespace'=>'TourOperator',

] ,function () {

    Route::group([ 'prefix' => 'tourOperator',  'as' => 'tourOperator.'], function() {
        Route::get('/register', 'tourOperatorController@create')->name('register');
        Route::get('/show/{tour_operator_company}', 'tourOperatorController@show')->name('show');
        Route::post('/store', 'tourOperatorController@store')->name('store');
        Route::get('/getTourOperatorCompanies', 'tourOperatorController@getTourOperatorCompanies')->name('getTourOperatorCompanies');
        Route::get('/getVerifiedTourCompanies', 'tourOperatorController@getVerifiedTourCompanies')->name('getVerifiedTourCompanies');
        Route::get('/getUnverifiedTourCompanies', 'tourOperatorController@getUnverifiedTourCompanies')->name('getUnverifiedTourCompanies');
        Route::get('/index', 'tourOperatorController@index')->name('index');
        Route::get('/verifiedCompaniesIndex', 'tourOperatorController@verifiedCompaniesIndex')->name('verifiedCompaniesIndex');
        Route::get('/UnverifiedCompaniesIndex', 'tourOperatorController@UnverifiedCompaniesIndex')->name('UnverifiedCompaniesIndex');
        Route::get('/edit/{tour_operator_company}', 'tourOperatorController@edit')->name('edit');
        Route::put('/update/{tour_operator_company}', 'tourOperatorController@update')->name('update');
        Route::get('/delete/{tour_operator_company}', 'tourOperatorController@destroy')->name('delete');
        Route::get('/deletedTourCompaniesIndex', 'tourOperatorController@deletedTourCompaniesIndex')->name('deletedTourCompaniesIndex');
        Route::get('/getDeletedTourOperatorCompanies', 'tourOperatorController@getDeletedTourOperatorCompanies')->name('getDeletedTourOperatorCompanies');
        Route::get('/restoreDeletedTourCompany/{tourOperator}', 'tourOperatorController@restoreDeletedTourCompany')->name('restoreDeletedTourCompany');
        Route::get('/forceDeleteTourCompany/{tourOperator}', 'tourOperatorController@forceDeleteTourCompany')->name('forceDeleteTourCompany');
        Route::get('/showDeletedTourCompany/{tourOperator}', 'tourOperatorController@showDeletedTourCompany')->name('showDeletedTourCompany');
    });




});
