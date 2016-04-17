<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

//------------Autentifikacija-------------------Jovic Aleksandar

Route::auth();
//Rute koje se koriste su:

$this->get('prijava', 'Auth\AuthController@showLoginForm');
$this->post('prijava', 'Auth\AuthController@login');
$this->get('odjava', 'Auth\AuthController@logout');

// Registration Routes...
$this->get('registracija', 'Auth\AuthController@showRegistrationForm');
$this->post('registracija', 'Auth\AuthController@register');

// Password Reset Routes...
$this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
$this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
$this->post('password/reset', 'Auth\PasswordController@reset');


//-------------------------------
