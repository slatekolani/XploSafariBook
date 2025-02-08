<?php

Route::group([

    'namespace'=>'TouristicAttraction\category',

] ,function () {

    Route::group([ 'prefix' => 'touristicAttractionCategory',  'as' => 'touristicAttractionCategory.'], function() {
        Route::get('/create', 'touristicAttractionCategoryController@create')->name('create');
        Route::post('/store', 'touristicAttractionCategoryController@store')->name('store');
        Route::get('/edit/{attractionCategoryUuid}', 'touristicAttractionCategoryController@edit')->name('edit');
        Route::get('/show/{attractionCategoryUuid}', 'touristicAttractionCategoryController@show')->name('view');
        Route::get('/delete/{attractionCategoryUuid}', 'touristicAttractionCategoryController@destroy')->name('delete');
        Route::get('/getTouristicAttractionCategories', 'touristicAttractionCategoryController@getTouristicAttractionCategories')->name('getTouristicAttractionCategories');
        Route::get('/index', 'touristicAttractionCategoryController@index')->name('index');
        Route::put('/update/{attractionCategoryUuid}', 'touristicAttractionCategoryController@update')->name('update');
    });




});
