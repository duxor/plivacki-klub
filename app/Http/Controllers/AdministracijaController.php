<?php

namespace App\Http\Controllers;

use App\Http\Requests\DodajObjavu;
use App\Objava;

class AdministracijaController extends Controller{
    private $imgFolder='img/objava';
    public function __construct(){
        
    }
    public function getIndex(){
        return view('admin.index');
    }
    public function getDodajObjavu(){
        return view('admin.dodaj-objavu');
    }
    public function postDodajObjavu(DodajObjavu $podaci){
        if(!is_dir($this->imgFolder)) mkdir($this->imgFolder);
        if($podaci['foto']->isValid()){
            $foto=round(microtime(true)*1000).'_'.explode('.',$podaci['foto']->getClientOriginalName())[0].'.'.$podaci['foto']->getClientOriginalExtension();
            $podaci['foto']->move(
                $this->imgFolder,
                $foto
            );
        }
        $dodaci=[];
        if(sizeof($podaci['dodaci']))
            foreach($podaci['dodaci'] as $dodatak)
                if($dodatak->isValid()){
                    $url=round(microtime(true)*1000).'_'.explode('.',$dodatak->getClientOriginalName())[0].'.'.$dodatak->getClientOriginalExtension();
                    array_push($dodaci,$url);
                    $dodatak->move(
                        $this->imgFolder,
                        $url
                    );
                }
        Objava::insert([
            array_merge($podaci->except(['_token','dodaci','foto']),[
                'dodaci'=>json_encode($dodaci),
                'slug'=>strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $podaci['naslov'])),
                'foto'=>$foto
            ])
        ]);
        return'Odradjeno kako valja!';
    }
}