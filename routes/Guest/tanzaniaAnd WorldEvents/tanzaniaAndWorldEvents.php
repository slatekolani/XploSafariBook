<?php

Route::group([

    'namespace'=>'tanzaniaAndWorldEvents',

] ,function () {

    Route::group([ 'prefix' => 'event',  'as' => 'event.'], function() {
        Route::get('spotLocalSafaris/{eventUuid}', 'tanzaniaAndWorldEventsController@spotLocalSafaris')->name('spotLocalSafaris');
    });




});
