<?php

Route::group([
    'namespace' => 'Access',
    'middleware' => ['web','auth']
], function() {



    Route::group([ 'prefix' => 'user',  'as' => 'user.'], function() {

        Route::get('/profile/{user}', 'UserController@profile')->name('profile');
        Route::get('/{user}/edit', 'UserController@edit')->name('edit');
        Route::put('/update/{user}', 'UserController@update')->name('update');
        Route::put('/change_password/{user}', 'UserController@changePassword')->name('change_password');

    });

});



