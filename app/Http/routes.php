<?php

/**
 *  Admin routes.
 */
Route::get('/admins', 'Admin\HomeController@index');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::resource('facility', 'FacilityController');
    Route::resource('user', 'UsersController');

});

/**
 * Reset password
 */
Route::post('resetPassword', 'UsersController@resetPassword');

/**
 * Client routes
 */

Route::resource('flat', 'FlatController');
Route::resource('user', 'UsersController');
Route::resource('shortlist', 'ShortlistsController');
Route::resource('report', 'ReportsController');
Route::resource('message', 'MessagesController');

Route::get('/locality', 'FlatController@getLocality');
Route::get('/vdc', 'FlatController@getVdc');

Route::get('/filterData', 'FlatController@getFilterData');

// Default Routes

// Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');

// Authentication routes.

Route::get('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes.

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Socialite routes.
Route::get('login/{provider?}', 'Auth\AuthController@redirectToProvider');
Route::get('login/{provider?}/callback', 'Auth\AuthController@handleProviderCallback');
