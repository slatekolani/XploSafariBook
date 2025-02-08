<?php

Route::group([

    'namespace'=>'customerSatisfactionCategory',

] ,function () {

    Route::group([ 'prefix' => 'customerSatisfactionCategory',  'as' => 'customerSatisfactionCategory.'], function() {
        Route::get('/spotLocalSafaris/{customerSatisfactionCategoryUuid}', 'customerSatisfactionCategoryController@spotLocalSafaris')->name('spotLocalSafaris');

    });




});
