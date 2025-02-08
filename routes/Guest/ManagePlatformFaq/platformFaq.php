<?php

Route::group([

    'namespace'=>'platformFaq',

] ,function () {

    Route::group([ 'prefix' => 'platformFaq',  'as' => 'platformFaq.'], function() {
        Route::get('/publicView', 'platformFaqController@publicView')->name('publicView');
    });
});
