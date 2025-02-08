<?php

Route::group([

    'namespace'=>'Admin',

] ,function () {

    Route::group([ 'prefix' => 'touristicAttraction',  'as' => 'touristicAttraction.'], function() {
        Route::get('/index', 'touristicAttractionsController@index')->name('index');
        Route::post('/store', 'touristicAttractionsController@store')->name('store');
        Route::get('/create', 'touristicAttractionsController@create')->name('create');
        Route::get('/getTouristicAttractions', 'touristicAttractionsController@getTouristicAttractions')->name('getTouristicAttractions');
        Route::get('/activateAttraction', 'touristicAttractionsController@activateAttraction')->name('activateAttraction');
        Route::get('/delete/{touristicAttraction}', 'touristicAttractionsController@destroy')->name('delete');
        Route::get('/edit/{touristicAttractionUuid}', 'touristicAttractionsController@edit')->name('edit');
        Route::get('/publicView/{touristicAttraction}', 'touristicAttractionsController@publicView')->name('publicView');
        Route::put('/update/{touristicAttraction}', 'touristicAttractionsController@update')->name('update');
        Route::get('/touristAttractionFAQ/{touristicAttraction}', 'touristicAttractionsController@touristAttractionFAQ')->name('touristAttractionFAQ');
        Route::get('/touristAttractionFAQIndex/{touristicAttraction}', 'touristicAttractionsController@touristAttractionFAQIndex')->name('touristAttractionFAQIndex');
        Route::get('/getTouristicAttractionsFAQ/{touristicAttraction}', 'touristicAttractionsController@getTouristicAttractionsFAQ')->name('getTouristicAttractionsFAQ');
        Route::get('/activateFAQ', 'touristicAttractionsController@activateFAQ')->name('activateFAQ');
        Route::post('/touristAttractionFaqStore', 'touristicAttractionsController@touristAttractionFaqStore')->name('touristAttractionFaqStore');
        Route::get('/editTouristAttractionFAQ/{touristAttractionFaq}', 'touristicAttractionsController@editTouristAttractionFAQ')->name('editTouristAttractionFAQ');
        Route::put('/updateTouristAttractionFAQ/{touristAttractionFaq}', 'touristicAttractionsController@updateTouristAttractionFAQ')->name('updateTouristAttractionFAQ');
        Route::get('/deleteTouristAttractionFAQ/{touristAttractionFaq}', 'touristicAttractionsController@deleteTouristAttractionFAQ')->name('deleteTouristAttractionFAQ');
        Route::get('/deleteVisitAdvice/{visitAdviceUuid}', 'touristicAttractionsController@deleteVisitAdvice')->name('deleteVisitAdvice');
        Route::get('/deleteVisitReason/{visitReasonUuid}', 'touristicAttractionsController@deleteVisitReason')->name('deleteVisitReason');
    });




});
