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
use Illuminate\Support\Facades\Input;
use App\Takmicar;

Route::get('/', function () {
    return view('index')
        ->with('objave',Objava::getObjaveZaPocetnu())
        ->with('slajder',Objava::getSlajder())
        ->with('takmicari',Takmicar::takmicariZaPocetnu())
        ->with('kalendar',Objava::getKalendarZaTekuci())
        ->with('admin',Auth::check());
});

Route::auth();
Route::controller('/rezultati','RezultatiController');
Route::controller('/norme','NormeController');
Route::controller('/takmicari','TakmicariController');
Route::controller('/administracija','AdministracijaController');

Route::get('/vizija-kluba',function(){
    return view('vizija-kluba');
});
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
Route::post('/kontakt',function(){
    //UNIJETI MEJL NA KOJI SE SALJU PORUKE SA KONTAKT FORME (RADUI NA REALNOM SERVERU)
    //mail('to@mejl.com','PORUKA SA SAJTA od: '.Input::get('ime'),'Adresa pošiljaoca: '.Input::get('email').' PORUKA: '.Input::get('poruka'));
    return json_encode(['msg'=>'Poruka uspešno poslata.']);
});
Route::get('/{slug}',function($slug){
    return view('objava')
        ->with('objava', Objava::dajObjavu($slug))
        ->with('admin',Auth::check());
});

