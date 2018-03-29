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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/oauth/{provider}','Auth\OAuthController@providerRedirect')->where('provider','twitter|facebook|linkedin|google|github|bitbucket')->name('oauth.redirect');
Route::get('/oauth/{provider}/callback','Auth\OAuthController@providerCallback')->where('provider','twitter|facebook|linkedin|google|github|bitbucket')->name('oauth.callback');

Route::get('/email/verify/{token}', 'Auth\RegisterController@verifyUser')->name('email.verify');
Route::get('/email/verify', 'Auth\RegisterController@showResendVerificationForm')->name('email.verifyForm');
Route::post('/email/verify', 'Auth\RegisterController@resendVerificationEmail')->name('email.verify.send');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('logout/', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

});
