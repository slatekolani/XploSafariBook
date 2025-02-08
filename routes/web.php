<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('home');
//})->name('home');

Route::get('/debug', function () {
    return view('debug');
});

// Switch between the included languages
Route::get('lang/{lang}', 'LanguageController@swap');

Auth::routes(['verify' => true]);
// Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/registered/{user}', 'Auth\RegisterController@showRegisteredForm')->name("auth.registered");
Route::get('/account/sms_confirm/{user}', 'Auth\ConfirmAccountController@smsConfirm')->name("auth.account.sms_confirm");
Route::post('/account/confirm/resend/{user}', 'Auth\ConfirmAccountController@resendConfirmationNotifications')->name("auth.account.confirm.resend");
Route::get('/verification/{user}', 'Auth\LoginController@verification')->name("auth.verification");
Route::get('/redirect-to', 'Auth\LoginController@redirectTo')->name("auth.redirect");
Route::get('/account/confirm/{token}', 'Auth\ConfirmAccountController@confirm')->name("auth.account.confirm");
Route::post('/account/confirm/{user}', 'Auth\ConfirmAccountController@confirmAccountCode')->name("auth.account.confirm.code");
Route::post('/account/confirm/resend/email/{user}', 'Auth\ConfirmAccountController@sendConfirmationEmail')->name("auth.account.confirm.resend.email");
Route::post('/account/confirm/resend/sms/{user}', 'Auth\ConfirmAccountController@sendConfirmationSms')->name("auth.account.confirm.resend.sms");
Route::get('/forgot_password', 'Auth\ResetPasswordController@showResetForm')->name('auth.forgot_password');
Route::post('/reset_pasword', 'Auth\ResetPasswordController@resetPassword')->name('auth.reset_password');
Route::get('/reset_password/{token}', 'Auth\ResetPasswordController@resetForm')->name('auth.form');
Route::post('/reset_password/{token}', 'Auth\ResetPasswordController@reset')->name('auth.form.reset');



Route::get('/dashboard', 'DashboardController@index');

includeRouteFiles(__DIR__.'/Guest/');


Route::group(['middleware' => 'dashboard'], function () {
    Route::group(['middleware' => 'csrf'], function () {
        includeRouteFiles(__DIR__.'/Web/');
    });
    includeRouteFiles(__DIR__.'/DataAccess/');
    includeRouteFiles(__DIR__.'/TokenFree/');
});

Route::group(['middleware' => 'csrf'], function () {
    includeRouteFiles(__DIR__.'/Public/');
});




