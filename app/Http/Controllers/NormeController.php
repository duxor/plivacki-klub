<?php

namespace App\Http\Controllers;
use App\Http\Requests\DodajNorme;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Norme;
use App\Stil;
use App\Rezultati;
use App\Objava;
use App\NormeInfo;
use DB;

class NormeController extends Controller
{
    public function getIndex(){
        $norme=Norme::all();
        return view('norme',compact('norme'));
    }
    public function getDodajNorme(){
    	$stil=Stil::lists('naziv','id');
    	$naziv_takmicenjalists=Objava::lists('naslov','id');
        $naziv_takmicenja=Norme::join('objava','objava.id','=','norme.takmicenje_naziv')->groupBy('norme.takmicenje_naziv')->get(['objava.naslov','objava.id'])->toArray();
       // dd( $naziv_takmicenja);
        return view('admin.dodaj-norme',compact('stil','norme_takmicenja','naziv_takmicenjalists','naziv_takmicenja'));
    }
    public function postDodajTakmicenje(Request $request){
    	$takmicenje=new Takmicenja();
    	$takmicenje->takmicenje=$request->takmicenje;
    	$takmicenje->norme_informacije=$request->norme_informacije;
    	$takmicenje->save();
    	return redirect::back()->with('uspesnoDodavanje','Uspešno ste izvršili unos!');
    }
    public function postDodajNorme(DodajNorme $podaci, $editMsg=null,$id=null){
    	    $stil=Stil::lists('naziv','id');

    		$konacniPodaci=$podaci->except(['_token','update_norme','norme_id','stil']);
            $konacniPodaci['takmicenje_naziv']=$podaci->get('takmicenje_naziv');
            $konacniPodaci['godiste']=$podaci->get('godiste');
            $konacniPodaci['stil_id']=$podaci->get('stil');
            $konacniPodaci['norme_zenski']=date('Y-m-d H:i',strtotime($podaci->get('norme_zenski')));
            $konacniPodaci['norme_muski']=date('Y-m-d H:i',strtotime($podaci->get('norme_muski')));


        if($podaci['update_norme']==1){
            $id=$podaci->get('norme_id');
            Norme::where('id',$id)->update($konacniPodaci);
            return Redirect::to('/norme/dodaj-norme');
        }else
            Norme::insert([$konacniPodaci]);
        return Redirect::to('/norme/dodaj-norme');
    }
    public function postUcitajRezultate(Request $request){
    	if ($request->ajax()) {
           $norme= Norme::join('stil','stil.id','=','norme.stil_id')->where('norme.takmicenje_naziv','=',$request->id)->get(['norme.id','norme.godiste','norme.norme_muski','norme_zenski','norme.takmicenje_naziv','stil.naziv','norme.stil_id']);
            return json_encode($norme);
    	}
    }
    public function getObrisiNormu($id){
        Norme::where('takmicenje_naziv','=',$id)->delete();
        return Redirect::to('/norme/dodaj-norme');
    }
    public function postUcitajObjavu(Request $request){
        return json_encode(Objava::where('objava.id','=',$request->id)->get());
    }
}
