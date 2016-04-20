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
// NASLOVNA-FOTOGRAFIJA START::
        if($podaci->exists('foto'))
            if($podaci['foto']->isValid()){
                $foto=round(microtime(true)*1000).'_'.explode('.',$podaci['foto']->getClientOriginalName())[0].'.'.$podaci['foto']->getClientOriginalExtension();
                $podaci['foto']->move(
                    $this->imgFolder,
                    $foto
                );
                $foto='/'.$this->imgFolder.'/'.$foto;
            }else $foto=null;
        else $foto=null;
// NASLOVNA-FOTOGRAFIJA END::

// DODACI START::
        $dodaci=[];
        if($podaci['dodaci'][0])
            foreach($podaci['dodaci'] as $dodatak)
                if($dodatak->isValid()){
                    $url=round(microtime(true)*1000).'_'.explode('.',$dodatak->getClientOriginalName())[0].'.'.$dodatak->getClientOriginalExtension();
                    array_push($dodaci,$url);
                    $dodatak->move(
                        $this->imgFolder,
                        $url
                    );
                }
// DODACI END::

// SLUG-KREATOR START::
        $slug=null;
        $tmp=strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $podaci['naslov']));
        if($tmp[strlen($tmp)-1]=='-') $tmp=substr($tmp,0,strlen($tmp)-1);
        $i=0;
        while(!$slug){
            if(!Objava::where('slug',$tmp.($i==0?'':'-'.$i))->exists()) $slug=$tmp.($i==0?'':'-'.$i);
            $i++;
        }
// SLUG-KREATOR END::

        Objava::insert([
            array_merge($podaci->except(['_token','dodaci','foto','datum']),[
                'dodaci'=>json_encode($dodaci),
                'slug'=>$slug,
                'foto'=>$foto,
                'datum'=>date('Y-m-d H:i',strtotime($podaci->get('datum')))
            ])
        ]);
        return view('admin.dodaj-objavu')->with('uspesnoDodavanje','Uspešno ste izvršili dodavanje nove objave.');
    }
}