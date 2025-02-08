<?php

Route::group([

    'namespace'=>'customerSatisfactionCategory',

] ,function () {

    Route::group([ 'prefix' => 'customerSatisfactionCategory',  'as' => 'customerSatisfactionCategory.'], function() {
        Route::get('/create', 'customerSatisfactionCategoryController@create')->name('create');
        Route::get('/index', 'customerSatisfactionCategoryController@index')->name('index');
        Route::get('/getCustomerSatisfactionCategory', 'customerSatisfactionCategoryController@getCustomerSatisfactionCategory')->name('getCustomerSatisfactionCategory');
        Route::get('/show/{satisfactionCategoryUuid}', 'customerSatisfactionCategoryController@show')->name('view');
        Route::get('/edit/{satisfactionCategoryUuid}', 'customerSatisfactionCategoryController@edit')->name('edit');
        Route::get('/destroy/{satisfactionCategoryUuid}', 'customerSatisfactionCategoryController@destroy')->name('delete');
        Route::post('/store', 'customerSatisfactionCategoryController@store')->name('store');
        Route::put('/update/{satisfactionCategoryUuid}', 'customerSatisfactionCategoryController@update')->name('update');
    });




});
