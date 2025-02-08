<?php

Route::group([

    'namespace'=>'Admin',

] ,function () {

    Route::group([ 'prefix' => 'tourOperatorCompaniesManagement',  'as' => 'tourOperatorCompaniesManagement.'], function() {
        Route::get('/register', 'tourOperatorCompaniesManagement@create')->name('register');
        Route::get('/show/{tour_operator_company}', 'tourOperatorCompaniesManagement@show')->name('show');
        Route::post('/store', 'tourOperatorCompaniesManagement@store')->name('store');
        Route::get('/edit/{tour_operator_company}', 'tourOperatorCompaniesManagement@edit')->name('edit');
        Route::put('/update/{tour_operator_company}', 'tourOperatorCompaniesManagement@update')->name('update');
        Route::get('/index', 'tourOperatorCompaniesManagementController@index')->name('index');
        Route::get('/verifiedTourOperatorsCompaniesIndex', 'tourOperatorCompaniesManagementController@verifiedTourOperatorsCompaniesIndex')->name('verifiedTourOperatorsCompaniesIndex');
        Route::get('/unverifiedTourOperatorsCompaniesIndex', 'tourOperatorCompaniesManagementController@unverifiedTourOperatorsCompaniesIndex')->name('unverifiedTourOperatorsCompaniesIndex');
        Route::get('/getTourOperatorsCompanies', 'tourOperatorCompaniesManagementController@getTourOperatorsCompanies')->name('getTourOperatorsCompanies');
        Route::get('/getVerifiedTourOperatorsCompanies', 'tourOperatorCompaniesManagementController@getVerifiedTourOperatorsCompanies')->name('getVerifiedTourOperatorsCompanies');
        Route::get('/getUnverifiedTourOperatorsCompanies', 'tourOperatorCompaniesManagementController@getUnverifiedTourOperatorsCompanies')->name('getUnverifiedTourOperatorsCompanies');
        Route::get('/ActivateOrDeactivateCompany', 'tourOperatorCompaniesManagementController@ActivateOrDeactivateCompany')->name('ActivateOrDeactivateCompany');
        Route::get('/deletedTourCompaniesIndex', 'tourOperatorCompaniesManagementController@deletedTourCompaniesIndex')->name('deletedTourCompaniesIndex');
        Route::get('/getDeletedTourOperatorCompanies', 'tourOperatorCompaniesManagementController@getDeletedTourOperatorCompanies')->name('getDeletedTourOperatorCompanies');
        Route::get('/delete/{tour_operator_company}', 'tourOperatorCompaniesManagementController@destroy')->name('delete');
        Route::get('/deletedTourCompaniesIndex', 'tourOperatorCompaniesManagementController@deletedTourCompaniesIndex')->name('deletedTourCompaniesIndex');
        Route::get('/restoreDeletedTourCompany/{tourOperator}', 'tourOperatorCompaniesManagementController@restoreDeletedTourCompany')->name('restoreDeletedTourCompany');
        Route::get('/forceDeleteTourCompany/{tourOperator}', 'tourOperatorCompaniesManagementController@forceDeleteTourCompany')->name('forceDeleteTourCompany');
        Route::get('/showDeletedTourCompany/{tourOperator}', 'tourOperatorCompaniesManagementController@showDeletedTourCompany')->name('showDeletedTourCompany');
    });




});
