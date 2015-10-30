<?php

/* Front routes */
Route::get('/', 'IndexController@index');
Route::post('contacts', ['as' => 'contacts', 'uses' => 'IndexController@contacts']);
Route::post('feedback', ['as' => 'feedback', 'uses' => 'IndexController@feedback']);
Route::post('subscribe', ['as' => 'subscribe', 'uses' => 'IndexController@subscribe']);
Route::get('unsubscribe', ['as' => 'unsubscribe', 'uses' => 'IndexController@unsubscribe']);

// Auth routes
Route::group(['prefix' => 'auth'], function()
{
    Route::get('register', ['as' => 'register', 'uses' =>'Auth\AuthController@getRegister']);
    Route::post('register', 'Auth\AuthController@postRegister');
    Route::get('login', ['as' => 'login', 'uses' =>'Auth\AuthController@getLogin']);
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', ['as' => 'logout', 'uses' =>'Auth\AuthController@getLogout']);
});

// Password routes
Route::group(['prefix' => 'password'], function()
{
    Route::get('email', ['as' => 'email', 'uses' =>'Auth\PasswordController@getEmail']);
    Route::post('email', 'Auth\PasswordController@postEmail');
    Route::get('reset/{token?}', ['as' => 'reset', 'uses' =>'Auth\PasswordController@getReset']);
    Route::post('reset', 'Auth\PasswordController@postReset');
});



/* Admin routes */
Route::group(['prefix' => 'admin'], function()
{
    ## Auth routes
    Route::get('login', ['as' => 'admin.login', 'uses' =>'Admin\Auth\AuthController@getLogin']);
    Route::post('login', 'Admin\Auth\AuthController@postLogin');
    Route::get('logout', ['as' => 'admin.logout', 'uses' =>'Admin\Auth\AuthController@getLogout']);

    // Admin Models
    Route::group(['middleware' => 'admin'], function()
    {
        Route::get('/', ['as' => 'admin', 'uses' =>'Admin\HomeController@index']);

        Route::resource('lunchs', 'Admin\LunchsController');
        Route::resource('meal1', 'Admin\Meal1Controller');
        Route::resource('meal2', 'Admin\Meal2Controller');
        Route::resource('garnishs', 'Admin\GarnishsController');
        Route::resource('salads', 'Admin\SaladsController');
        Route::resource('drinks', 'Admin\DrinksController');
        Route::resource('additions', 'Admin\AdditionsController');
        Route::resource('users', 'Admin\UsersController');

        Route::get('subs/{user}', ['as' => 'showSubs', 'uses' => 'Admin\SubsController@showSubs']);
        Route::post('subs/{user}', ['as' => 'saveSubs', 'uses' => 'Admin\SubsController@saveSubs']);
    });
});