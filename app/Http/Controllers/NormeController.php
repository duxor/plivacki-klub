<?php

namespace App\Http\Controllers;
use App\Http\Requests\DodajNorme;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Redirect;
use Session;

use App\Http\Requests;
use App\Norme;
use App\Stil;
use App\Rezultati;
use App\Objava;
use DB;

class NormeController extends Controller
{
    public function getIndex(){
        $id_takmicenja= Norme::join('stil','stil.id','=','norme.stil_id')->pluck('norme.takmicenje_naziv')->first();
        $norme=Norme::join('stil','stil.id','=','norme.stil_id')->join('objava','objava.id','=','norme.takmicenje_naziv')->where('norme.takmicenje_naziv','=',$id_takmicenja)->get(['norme.godiste','norme.norme_muski','norme_zenski','objava.naslov','stil.naziv'])->toArray();
        $naziv_takmicenja=Norme::join('objava','objava.id','=','norme.takmicenje_naziv')->groupBy('norme.takmicenje_naziv')->get(['objava.naslov','objava.id'])->toArray();
        return view('norme',compact(['naziv_takmicenja','norme']));
    }
    public function getDodajNorme(){
        $poslednja_godina=date('Y');
    	$stil=Stil::lists('naziv','id');
    	$naziv_takmicenjalists=Objava::lists('naslov','id');
        $naziv_takmicenja=Norme::join('objava','objava.id','=','norme.takmicenje_naziv')->groupBy('norme.takmicenje_naziv')
            ->get(['objava.naslov','objava.id'])->toArray();
       // dd( $naziv_takmicenja);
        return view('admin.dodaj-norme',compact('stil','norme_takmicenja','naziv_takmicenjalists','naziv_takmicenja','poslednja_godina'));
    }
    public function getIzmeniNormu($id){
        $poslednja_godina=date('Y');
        $stil=Stil::lists('naziv','id');
        $naziv_takmicenjalists=Objava::lists('naslov','id');
        $naziv_takmicenja=Norme::join('objava','objava.id','=','norme.takmicenje_naziv')->groupBy('norme.takmicenje_naziv')->get(['objava.naslov','objava.id'])->toArray();
        $izmene=Norme::join('stil','stil.id','=','norme.stil_id')
            ->join('objava','objava.id','=','norme.takmicenje_naziv')
            ->where('norme.takmicenje_naziv','=',$id)
            ->get(['norme.godiste','norme.norme_muski','norme_zenski','objava.naslov','stil.naziv','norme.takmicenje_naziv'])->toArray();
        return view('admin.dodaj-norme',compact('stil','norme_takmicenja','naziv_takmicenjalists','naziv_takmicenja','poslednja_godina','izmene'));

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
            return Redirect::to('/norme/dodaj-norme')->with('poruka', 'Uspešno ste izvršili ažuriranje');
        }else
            Norme::insert([$konacniPodaci]);
        return Redirect::to('/norme/dodaj-norme')->with('poruka', 'Uspešno ste izvršili dodavanje')->with('old',$podaci->get('takmicenje_naziv'));
    }
    public function postUcitajRezultate(Request $request){
    	if ($request->ajax()) {
           $norme= Norme::join('stil','stil.id','=','norme.stil_id')->join('objava','objava.id','=','norme.takmicenje_naziv')
               ->where('norme.takmicenje_naziv','=',$request->id)
               ->get(['norme.id','norme.godiste','norme.norme_muski','norme_zenski','norme.takmicenje_naziv','stil.naziv','norme.stil_id','objava.sadrzaj']);
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
