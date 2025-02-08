<?php

Route::group([

    'namespace'=>'news',

] ,function () {

    Route::group([ 'prefix' => 'news',  'as' => 'news.'], function() {
        Route::get('/publicView', 'newsController@publicView')->name('publicView');
    });




});
