<?php

Route::group(['namespace' => 'OutletUser'], function() {
    Route::get('/', 'HomeController@index')->name('outletuser.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('outletuser.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('outletuser.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('outletuser.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('outletuser.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('outletuser.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('outletuser.password.reset');

});