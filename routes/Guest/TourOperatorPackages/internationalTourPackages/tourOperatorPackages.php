<?php


Route::group([

    'namespace' => 'TourOperator\TourOperatorPackages\InternationalTourPackages',

], function () {

    Route::group(['prefix' => 'tourPackages', 'as' => 'tourPackages.'], function () {
        Route::get('/publicView/{tourPackage}', 'TourPackagesController@publicView')->name('publicView');
        Route::get('/allInternationalTourPackages', 'TourPackagesController@allInternationalTourPackages')->name('allInternationalTourPackages');
        Route::get('/recentPostedTourPackages', 'TourPackagesController@recentPostedTourPackages')->name('recentPostedTourPackages');
        Route::get('/search', 'TourPackagesController@search')->name('search');
        Route::get('/getAllInternationalTourPackagesOnSearch', 'TourPackagesController@getAllInternationalTourPackagesOnSearch')->name('getAllInternationalTourPackagesOnSearch');
        Route::get('/nearInternationalToursToBeConducted', 'TourPackagesController@nearToursToBeConducted')->name('nearToursToBeConducted');
        Route::get('/noInternationalPackagePostedSearchRecommendation', 'TourPackagesController@noInternationalPackagePostedSearchRecommendation')->name('noInternationalPackagePostedSearchRecommendation');
    });


});
