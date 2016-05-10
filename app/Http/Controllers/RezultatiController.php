<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\DodajRezultat;
use Storage;
use App\Rezultati;
use App\Objava;

class RezultatiController extends Controller{
	 private $rezultatiFolder='rezultati-takmicenja';

    public function getIndex(){

        $rezultati=Rezultati::join('objava','objava.id','=','rezultati.objava_id')->orderBy('rezultati.created_at','desc')->get();

        return view('rezultati',compact('rezultati'));
    }
    public function getDodajRezultate(){
        $naziv_takmicenjalists=Objava::lists('naslov','id');
        return view('admin.dodaj-rezultate',compact(['naziv_takmicenjalists']));
    }
    public function postDodajRezultate(DodajRezultat $podaci, $editMsg=null,$id=null){
        if(!is_dir($this->rezultatiFolder)) mkdir($this->rezultatiFolder);

        if($podaci->exists('klupski_rezultati'))
                if($podaci['klupski_rezultati']->isValid()){
                    $klupski_rezultati=round(microtime(true)*1000).'_'.explode('.',$podaci['klupski_rezultati']->getClientOriginalName())[0].'.'.$podaci['klupski_rezultati']->getClientOriginalExtension();
                    $podaci['klupski_rezultati']->move(
                        $this->rezultatiFolder,
                        $klupski_rezultati
                    );
                    $klupski_rezultati='/'.$this->rezultatiFolder.'/'.$klupski_rezultati;
                }else $klupski_rezultati=null;
            else $klupski_rezultati=null;
            /*---------------------------------------*/
            if($podaci->exists('sumarni_rezultati'))
                if($podaci['sumarni_rezultati']->isValid()){
                    $sumarni_rezultati=round(microtime(true)*1000).'_'.explode('.',$podaci['sumarni_rezultati']->getClientOriginalName())[0].'.'.$podaci['sumarni_rezultati']->getClientOriginalExtension();
                    $podaci['sumarni_rezultati']->move(
                        $this->rezultatiFolder,
                        $sumarni_rezultati
                    );
                    $sumarni_rezultati='/'.$this->rezultatiFolder.'/'.$sumarni_rezultati;
                }else $sumarni_rezultati=null;
            else $sumarni_rezultati=null;

            $konacniPodaci=$podaci->except(['_token','update_rezultati','rezultati_id','takmicenje_naziv']);
            $konacniPodaci['sumarni_rezultati']=$podaci->get('sumarni_rezultati');
            $konacniPodaci['klupski_rezultati']=$klupski_rezultati;
            $konacniPodaci['sumarni_rezultati']=$sumarni_rezultati;
            $konacniPodaci['objava_id']=$podaci->get('takmicenje_naziv');

        if($podaci['update_rezultati']==1){
            $id=$podaci->get('rezultati_id');
            Rezultati::where('id',$id)->update($konacniPodaci);
        }else  Rezultati::insert([$konacniPodaci]);
        return Redirect::to('/rezultati/dodaj-rezultate')->with('uspesnoDodavanje','Uspešno uneto!');
    }
    public function postUcitajRezultate(){
        return json_encode(Rezultati::join('objava','objava.id','=','rezultati.objava_id')
            ->orderBy('rezultati.created_at','desc')
            ->get(['rezultati.id','objava.id as objava_id','objava.naslov','objava.mesto','objava.datum','rezultati.klupski_rezultati','rezultati.sumarni_rezultati'])->toArray());
    }
    public function getObrisiRezultat($id,$editMsg=null){
        $klupski_rez_path=Rezultati::where('id',$id)->pluck('klupski_rezultati');
        $sumarni_rez_path=Rezultati::where('id',$id)->pluck('sumarni_rezultati');
        Storage::delete([$klupski_rez_path[0], $sumarni_rez_path[0]] );
        Rezultati::where('id',$id)->delete();
        return Redirect::back()->with('uspesnoDodavanje',$editMsg?$editMsg:'Uspešno obrisan rezultat!');
    }
}