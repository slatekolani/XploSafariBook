<?php


Route::group([

    'namespace' => 'TourOperator\TourOperatorPackages\InternationalTourPackages',

], function () {

    Route::group(['prefix' => 'tourPackages', 'as' => 'tourPackages.'], function () {
        Route::get('/create/{tourOperator}', 'TourPackagesController@create')->name('create');
        Route::get('/index/{tourOperator}', 'TourPackagesController@index')->name('index');
        Route::get('/delete/{tourOperator}', 'TourPackagesController@destroy')->name('delete');
        Route::get('/show/{tourPackage}', 'TourPackagesController@show')->name('show');
        Route::get('/delete/{tourPackage}', 'TourPackagesController@destroy')->name('delete');
        Route::post('/store', 'TourPackagesController@store')->name('store');
        Route::get('/edit/{tourPackage}', 'TourPackagesController@edit')->name('edit');
        Route::put('/update/{tourPackage}', 'TourPackagesController@update')->name('update');
        Route::get('/ActivateOrDeactivateInternationalTourPackage', 'TourPackagesController@ActivateOrDeactivateInternationalTourPackage')->name('ActivateOrDeactivateInternationalTourPackage');
        Route::get('/recentInternationalPostedTourPackagesIndex/{tourOperator}', 'TourPackagesController@recentInternationalPostedTourPackagesIndex')->name('recentInternationalPostedTourPackagesIndex');
        Route::get('/getRecentInternationalPostedTourPackages/{tourOperator}', 'TourPackagesController@getRecentInternationalPostedTourPackages')->name('getRecentInternationalPostedTourPackages');
        Route::get('/verifiedInternationalTourPackagesIndex/{tourOperator}', 'TourPackagesController@verifiedInternationalTourPackagesIndex')->name('verifiedInternationalTourPackagesIndex');
        Route::get('/getVerifiedInternationalTourPackages/{tourOperator}', 'TourPackagesController@getVerifiedInternationalTourPackages')->name('getVerifiedInternationalTourPackages');
        Route::get('/unverifiedInternationalTourPackagesIndex/{tourOperator}', 'TourPackagesController@unverifiedInternationalTourPackagesIndex')->name('unverifiedInternationalTourPackagesIndex');
        Route::get('/getUnVerifiedInternationalTourPackages/{tourOperator}', 'TourPackagesController@getUnVerifiedInternationalTourPackages')->name('getUnVerifiedInternationalTourPackages');
        Route::get('/nearInternationalToursToBeConductedIndex/{tourOperator}', 'TourPackagesController@nearInternationalToursToBeConductedIndex')->name('nearInternationalToursToBeConductedIndex');
        Route::get('/getNearInternationalToursToBeConducted/{tourOperator}', 'TourPackagesController@getNearInternationalToursToBeConducted')->name('getNearInternationalToursToBeConducted');
        Route::get('/expiredInternationalTourPackagesIndex/{tourOperator}', 'TourPackagesController@expiredInternationalTourPackagesIndex')->name('expiredInternationalTourPackagesIndex');
        Route::get('/getExpiredInternationalTourPackages/{tourOperator}', 'TourPackagesController@getExpiredInternationalTourPackages')->name('getExpiredInternationalTourPackages');
        Route::get('/getCompanyInternationalTourPackages/{tourOperator}', 'TourPackagesController@getCompanyInternationalTourPackages')->name('getCompanyInternationalTourPackages');
        Route::get('/companyInternationalTourPackagesIndex/{tourOperator}', 'TourPackagesController@companyInternationalTourPackagesIndex')->name('companyInternationalTourPackagesIndex');
        Route::get('/deletedInternationalTourPackagesIndex/{tourOperator}', 'TourPackagesController@deletedInternationalTourPackagesIndex')->name('deletedInternationalTourPackagesIndex');
        Route::get('/getDeletedInternationalTourPackages/{tourOperator}', 'TourPackagesController@getDeletedInternationalTourPackages')->name('getDeletedInternationalTourPackages');
        Route::get('/restoreInternationalDeletedTourPackages/{tourPackage}', 'TourPackagesController@restoreInternationalDeletedTourPackages')->name('restoreInternationalDeletedTourPackages');
        Route::get('/renew/{tourPackage}', 'TourPackagesController@renew')->name('renew');
        Route::get('/forceDeleteInternationalTourPackages/{tourPackage}', 'TourPackagesController@forceDeleteInternationalTourPackages')->name('forceDeleteInternationalTourPackages');
        Route::get('/showDeletedTourPackage/{tourPackage}', 'TourPackagesController@showDeletedTourPackage')->name('showDeletedTourPackage');
    });


});
