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
use App\DuzinaBazena;
use App\Objava;
use App\Pol;
use App\Stil;
use App\Takmicar;
use \Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index')
        ->with('objave',Objava::getObjaveZaPocetnu())
        ->with('slajder',Objava::getSlajder())
        ->with('admin',Auth::check());
});
//Aleksandar Jovic
Route::auth();
Route::controller('/takmicari','TakmicariController');
Route::get('/takmicari/prikazi/{slug}', function ($slug) {
    return view('takmicari.takmicar')->with('takmicar', Takmicar::where('slug',$slug)->get()->first());
});


Route::get('/rekordi','TakmicariController@FormaRekordi');
Route::post('/rekordi/prikazi','TakmicariController@TabelaRekordi');
//End Aleksandar Jovic

Route::controller('/rezultati','RezultatiController');
Route::controller('/norme','NormeController');
Route::controller('/administracija','AdministracijaController');

Route::get('/kalendar',function(){
    $rezultat=Objava::getKalendar();
    return view('kalendar')->with('takmicenja',$rezultat['takmicenja'])->with('kalendar',$rezultat['kalendar'])
        ->with('admin',Auth::check());
});
Route::get('/galerija',function(){
    return view('galerije')->with('galerije',Objava::getGalerije());
});
Route::get('/vesti/{x?}',function($stranica=0){
    $return=Objava::ucitajStranicu($stranica);
    return view('objave')
        ->with('objave',$return['objave'])
        ->with('brojStranica',$return['brojStranica'])
        ->with('aktivna',$stranica)
        ->with('admin',Auth::check());
});

Route::get('/{slug}',function($slug){
    return view('objava')
        ->with('objava', Objava::dajObjavu($slug))
        ->with('admin',Auth::check());
});

