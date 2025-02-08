<?php

Route::group([

    'namespace'=>'Admin',

] ,function () {

    Route::group([ 'prefix' => 'nation',  'as' => 'nation.'], function() {
        Route::post('/store', 'nationsController@store')->name('store');
        Route::get('/create', 'nationsController@create')->name('create');
        Route::get('/index', 'nationsController@index')->name('index');
        Route::get('/activateNation', 'nationsController@activateNation')->name('activateNation');
        Route::get('/getNations', 'nationsController@getNations')->name('getNations');
        Route::get('/delete/{nation}', 'nationsController@destroy')->name('delete');
        Route::get('/deleteEconomicActivity/{nationEconomicActivityUuid}', 'nationsController@deleteEconomicActivity')->name('deleteEconomicActivity');
        Route::get('/deleteNationPrecaution/{nationPrecautionUuid}', 'nationsController@deleteNationPrecaution')->name('deleteNationPrecaution');
        Route::get('/edit/{nation}', 'nationsController@edit')->name('edit');
        Route::put('/update/{nation}', 'nationsController@update')->name('update');
    });




});
