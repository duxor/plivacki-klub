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
use App\Takmicar;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


Route::get('/', function () {
    return view('index')
        ->with('objave',Objava::getObjaveZaPocetnu())
        ->with('slajder',Objava::getSlajder())
        ->with('takmicari',Takmicar::takmicariZaPocetnu())
        ->with('kalendar',Objava::getKalendarZaTekuci())
        ->with('admin',Auth::check());
});


//Aleksandar Jovic
Route::auth();
Route::get('/takmicari/profil/{slug}', function ($slug) {
    return view('/takmicar')->with('takmicar', Takmicar::where('slug',$slug)->get()->first());
});
Route::controller('/takmicari','TakmicariController');


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
Route::post('/kontakt',function(){
    //UNIJETI MEJL NA KOJI SE SALJU PORUKE SA KONTAKT FORME (RADUI NA REALNOM SERVERU)
    if(strlen(Input::get('ime')) && strlen(Input::get('email')) && strlen(Input::get('poruka')))
        return json_encode(['msg'=>'Proverite podatke, iz bezbednosnih razlogo, ponovo učitajte stranicu i pokušajte ponovo.']);
    //mail('to@mejl.com','PORUKA SA SAJTA od: '.Input::get('ime'),'Adresa pošiljaoca: '.Input::get('email').' PORUKA: '.Input::get('poruka'));
    return json_encode(['msg'=>'Poruka uspešno poslata.']);
});
Route::get('/{slug}',function($slug){
    $objava=Objava::dajObjavu($slug);
    if($objava)
        return view('objava')
            ->with('objava', $objava)
            ->with('admin',Auth::check());
    else return view('errors.503');
});

