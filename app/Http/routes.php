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
use App\Objava;
use \Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index')
        ->with('objave',Objava::getObjaveSkraceno())
        ->with('slajder',Objava::getSlajder())
        ->with('admin',Auth::check());
});

Route::auth();
Route::controller('/administracija','AdministracijaController');