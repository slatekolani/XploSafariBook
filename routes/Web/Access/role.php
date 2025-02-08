<?php

Route::group([
    'middleware' => ['web','auth'],
    'namespace' => 'Access',
    'as' => 'access.',
], function() {


    /*Routes for Role and Permissions*/
    Route::resource('role', 'RoleController', ['except' => ['']]);

    Route::group([ 'prefix' => 'role',  'as' => 'role.'], function() {
        Route::get('/get/for_datatable', 'RoleController@getRolesForDataTable')->name('get_for_datatable');
    });

});



