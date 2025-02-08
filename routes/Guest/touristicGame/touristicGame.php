<?php

Route::group([

    'namespace'=>'touristicGames',

] ,function () {

    Route::group([ 'prefix' => 'touristicGame',  'as' => 'touristicGame.'], function() {
        Route::get('/publicView/{touristicGameUuid}', 'touristicGamesController@publicView')->name('publicView');
        Route::get('/allTouristicGames', 'touristicGamesController@allTouristicGames')->name('allTouristicGames');
    });




});
