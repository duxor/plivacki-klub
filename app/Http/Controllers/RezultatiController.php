<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\DodajRezultat;
use Storage;
use App\Rezultati;

class RezultatiController extends Controller{
	 private $rezultatiFolder='rezultati-takmicenja';

    public function getIndex(){

        $rezultati=Rezultati::all();
        return view('rezultati',compact('rezultati'));
    }
    public function getDodajRezultate(){
        return view('admin.dodaj-rezultate');
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

            $konacniPodaci=$podaci->except(['_token','update_rezultati','rezultati_id']);
            $konacniPodaci['sumarni_rezultati']=$podaci->get('sumarni_rezultati');
            $konacniPodaci['klupski_rezultati']=$klupski_rezultati;
            $konacniPodaci['sumarni_rezultati']=$sumarni_rezultati;
            $konacniPodaci['datum']=date('Y-m-d H:i',strtotime($podaci->get('datum')));
            $konacniPodaci['mesto']=$podaci->get('mesto');

        if($podaci['update_rezultati']==1){
            $id=$podaci->get('rezultati_id');
            Rezultati::where('id',$id)->update($konacniPodaci);
        }else  Rezultati::insert([$konacniPodaci]);
        
        return view('admin.dodaj-rezultate') ->with('uspesnoDodavanje',$podaci['update_rezultati']?'Uspešno ste izvršili azuriranje!':'Uspešno ste izvršili dodavanje novog rezultata!');
    }
    public function postUcitajRezultate(){
        return json_encode(Rezultati::orderBy('created_at','desc')->get()->toArray());
    }
    public function getObrisiRezultat($id,$editMsg=null){
        $klupski_rez_path=Rezultati::where('id',$id)->pluck('klupski_rezultati');
        $sumarni_rez_path=Rezultati::where('id',$id)->pluck('sumarni_rezultati');
        Storage::delete([$klupski_rez_path[0], $sumarni_rez_path[0]] );
        Rezultati::where('id',$id)->delete();
        return Redirect::back()->with('uspesnoDodavanje',$editMsg?$editMsg:'Uspešno obrisan rezultat!');
    }
}