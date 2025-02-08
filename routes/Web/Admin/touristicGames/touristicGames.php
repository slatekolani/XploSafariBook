<?php

Route::group([

    'namespace'=>'touristicGames',

] ,function () {

    Route::group([ 'prefix' => 'touristicGame',  'as' => 'touristicGame.'], function() {
        Route::get('/create', 'touristicGamesController@create')->name('create');
        Route::post('/store', 'touristicGamesController@store')->name('store');
        Route::get('/activateTouristicGame', 'touristicGamesController@activateTouristicGame')->name('activateTouristicGame');
        Route::get('/index', 'touristicGamesController@index')->name('index');
        Route::get('/getTouristicGames', 'touristicGamesController@getTouristicGames')->name('getTouristicGames');
        Route::get('/edit/{touristicGameUuid}', 'touristicGamesController@edit')->name('edit');
        Route::get('/deleteGameComponent/{touristicGameComponentUuid}', 'touristicGamesController@deleteGameComponent')->name('deleteGameComponent');
        Route::get('/destroy/{touristicGameUuid}', 'touristicGamesController@destroy')->name('delete');
        Route::get('/show/{touristicGameUuid}', 'touristicGamesController@show')->name('view');
        Route::put('/update/{touristicGameUuid}', 'touristicGamesController@update')->name('update');
    });




});
