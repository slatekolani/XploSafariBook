<?php

Route::group([

    'namespace'=>'Admin',
    'prefix' => 'admin',
    'as' => 'admin.'

] ,function () {

    Route::group([ 'prefix' => 'user_manage',  'as' => 'user_manage.'], function() {
        Route::get('/menu', 'UserManagementController@index')->name('index');
        Route::get('/system_users', 'UserManagementController@systemUsersList')->name('system_users');
        Route::get('/get_system_users_for_dt', 'UserManagementController@getSystemUsersForDt')->name('get_system_users_for_dt');
        Route::get('/activateUserStatus', 'UserManagementController@activateUserStatus')->name('activateUserStatus');
        Route::get('/create_system_user', 'UserManagementController@createSystemUser')->name('create_system_user');
        Route::post('/store_system_user', 'UserManagementController@storeSystemUser')->name('store_system_user');
        Route::get('/edit_system_user/{user}', 'UserManagementController@editSystemUser')->name('edit_system_user');
        Route::put('/update_system_user/{user}', 'UserManagementController@updateSystemUser')->name('update_system_user');
    });




});
