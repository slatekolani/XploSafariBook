<?php


Route::group([

    'namespace' => 'TourOperator\TourOperatorPackages\LocalTourPackages',

], function () {

    Route::group(['prefix' => 'localTourPackages', 'as' => 'localTourPackages.'], function () {
        Route::get('/create/{tourOperator}', 'localTourPackagesController@create')->name('create');
        Route::get('/edit/{tourOperatorUuid}', 'localTourPackagesController@edit')->name('edit');
        Route::put('/update/{tourOperatorUuid}', 'localTourPackagesController@update')->name('update');
        Route::post('/store', 'localTourPackagesController@store')->name('store');
        Route::get('/deleteCollectionStation/{collectionStopUuid}', 'localTourPackagesController@deleteCollectionStation')->name('deleteCollectionStation');
        Route::get('/deleteIncludedActivity/{includedActivityUuid}', 'localTourPackagesController@deleteIncludedActivity')->name('deleteIncludedActivity');
        Route::get('/deletePriceInclusiveItem/{priceInclusiveItemUuid}', 'localTourPackagesController@deletePriceInclusiveItem')->name('deletePriceInclusiveItem');
        Route::get('/deletePriceExclusiveItem/{priceExclusiveItemUuid}', 'localTourPackagesController@deletePriceExclusiveItem')->name('deletePriceExclusiveItem');
        Route::get('/deleteTripRequirement/{tripRequirementUuid}', 'localTourPackagesController@deleteTripRequirement')->name('deleteTripRequirement');
        Route::get('/ActivateOrDeactivateLocalTourPackage', 'localTourPackagesController@ActivateOrDeactivateLocalTourPackage')->name('ActivateOrDeactivateLocalTourPackage');
        Route::get('/getCompanyLocalTourPackages/{tourOperator}', 'localTourPackagesController@getCompanyLocalTourPackages')->name('getCompanyLocalTourPackages');
        Route::get('/index/{tourOperator}', 'localTourPackagesController@index')->name('index');
        Route::get('/delete/{localTourPackage}', 'localTourPackagesController@destroy')->name('delete');
        Route::get('/verifiedLocalPackagesIndex/{tourOperator}', 'localTourPackagesController@verifiedLocalPackagesIndex')->name('verifiedLocalPackagesIndex');
        Route::get('/getVerifiedLocalTourPackages/{tourOperator}', 'localTourPackagesController@getVerifiedLocalTourPackages')->name('getVerifiedLocalTourPackages');
        Route::get('/recentLocalPackagesIndex/{tourOperator}', 'localTourPackagesController@recentLocalPackagesIndex')->name('recentLocalPackagesIndex');
        Route::get('/getRecentLocalTourPackages/{tourOperator}', 'localTourPackagesController@getRecentLocalTourPackages')->name('getRecentLocalTourPackages');
        Route::get('/getUnverifiedLocalPackages/{tourOperator}', 'localTourPackagesController@getUnverifiedLocalPackages')->name('getUnverifiedLocalPackages');
        Route::get('/unverifiedLocalPackagesIndex/{tourOperator}', 'localTourPackagesController@unverifiedLocalPackagesIndex')->name('unverifiedLocalPackagesIndex');
        Route::get('/nearLocalToursIndex/{tourOperator}', 'localTourPackagesController@nearLocalToursIndex')->name('nearLocalToursIndex');
        Route::get('/getNearLocalTours/{tourOperator}', 'localTourPackagesController@getNearLocalTours')->name('getNearLocalTours');
        Route::get('/getExpiredLocalPackages/{tourOperator}', 'localTourPackagesController@getExpiredLocalPackages')->name('getExpiredLocalPackages');
        Route::get('/expiredLocalToursIndex/{tourOperator}', 'localTourPackagesController@expiredLocalToursIndex')->name('expiredLocalToursIndex');
        Route::get('/getDeletedLocalTourPackages/{tourOperator}', 'localTourPackagesController@getDeletedLocalTourPackages')->name('getDeletedLocalTourPackages');
        Route::get('/deletedLocalToursIndex/{tourOperator}', 'localTourPackagesController@deletedLocalToursIndex')->name('deletedLocalToursIndex');
        Route::get('/restore/{tourOperator}', 'localTourPackagesController@restore')->name('restore');
        Route::get('/forceDeleteLocalPackage/{tourOperator}', 'localTourPackagesController@forceDeleteLocalPackage')->name('forceDeleteLocalPackage');
        Route::get('/show/{localTourPackageUuid}', 'localTourPackagesController@show')->name('view');
        Route::get('/viewDeleted/{localTourPackageUuid}', 'localTourPackagesController@viewDeleted')->name('viewDeleted');
        Route::get('/replicateExpiredTour/{localTourPackageUuid}', 'localTourPackagesController@replicateExpiredTour')->name('replicateExpiredTour');
        Route::get('/replicateTourPackage/{localTourPackageUuid}', 'localTourPackagesController@replicateTourPackage')->name('replicateTourPackage');
    });


});
