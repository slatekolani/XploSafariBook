<?php


Route::group([

    'namespace' => 'TourOperator\TourOperatorPackages\LocalTourPackages',

], function () {

    Route::group(['prefix' => 'localTourPackage', 'as' => 'localTourPackage.'], function () {
        Route::get('/publicView/{localTourPackage}', 'localTourPackagesController@publicView')->name('view');
        Route::get('/allLocalTourPackages', 'localTourPackagesController@allLocalTourPackages')->name('allLocalTourPackages');
        Route::get('/search', 'localTourPackagesController@search')->name('search');
        Route::get('/getAllLocalTourPackagesOnSearch', 'localTourPackagesController@getAllLocalTourPackagesOnSearch')->name('getAllLocalTourPackagesOnSearch');
        Route::get('/noLocalPackageFoundTourOperatorsRecommendation', 'localTourPackagesController@noLocalPackageFoundTourOperatorsRecommendation')->name('noLocalPackageFoundTourOperatorsRecommendation');
        Route::get('/getMonthlyTourPackages/{selectedMonth}', 'localTourPackagesController@getMonthlyTourPackages')->name('getMonthlyTourPackages');
        Route::get('/localSafariAttractionCategory/{attractionCategoryUuid}', 'localTourPackagesController@localSafariAttractionCategory')->name('localSafariAttractionCategory');
        Route::get('/filterLocalTourPackages', 'localTourPackagesController@filterLocalTourPackages')->name('filterLocalTourPackages');
        Route::get('/noLocalSafariFound/{touristicAttractionUuid}', 'localTourPackagesController@noLocalSafariFound')->name('noLocalSafariFound');
        Route::get('/spotLocalTourPackagePlans/{localTourPackageRangeId}', 'localTourPackagesController@spotLocalTourPackagePlans')->name('spotLocalTourPackagePlans');
        Route::get('/TripKind/{trip_kind_name}', 'localTourPackagesController@TripKind')->name('TripKind');
        Route::get('/adventurePaymentTimeFramePlan/{package_range}', 'localTourPackagesController@adventurePaymentTimeFramePlan')->name('adventurePaymentTimeFramePlan');

    });


});
