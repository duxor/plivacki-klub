<?php

namespace App\Http\Controllers;
use App\Http\Requests\DodajNorme;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Norme;
use App\Stil;
use App\Rezultati;
use App\Takmicenja;
use DB;

class NormeController extends Controller
{
    public function getIndex(){
        $norme=Norme::all();
        return view('norme',compact('norme'));
    }
    public function getDodajNorme(){
    	$stil=Stil::lists('naziv','id');
    	$naziv_takmicenjalists=Takmicenja::lists('takmicenje','id');
    	$naziv_takmicenja=Takmicenja::get(['takmicenje','id'])->toArray();
    	//$norme_takmicenja=DB::table('norme')->join('takmicenja','takmicenja.id','=','norme.takmicenje_naziv')->paginate(3);
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

    		$konacniPodaci=$podaci->except(['_token','update_norme','norme_id']);
            $konacniPodaci['takmicenje_naziv']=$podaci->get('takmicenje_naziv');
            $konacniPodaci['godiste']=$podaci->get('godiste');
            $konacniPodaci['disciplina']=$podaci->get('disciplina');
            $konacniPodaci['norme_zenski']=date('Y-m-d H:i',strtotime($podaci->get('norme_zenski')));
            $konacniPodaci['norme_muski']=date('Y-m-d H:i',strtotime($podaci->get('norme_zenski')));


        if($podaci['update_norme']==1){
            $id=$podaci->get('rezultati_id');
            Norme::where('id',$id)->update($konacniPodaci);
        }else  Norme::insert([$konacniPodaci]);
        $naziv_takmicenja=Takmicenja::get(['takmicenje','id']);
        return view('admin.dodaj-norme',['stil' => $stil,'naziv_takmicenja'=>$naziv_takmicenja])->with('uspesnoDodavanje',$podaci['update_rezultati']?'Uspešno ste izvršili azuriranje!':'Uspešno ste izvršili dodavanje novog rezultata!');

    }
    public function postUcitajRezultate(Request $request){
    	if ($request->ajax()) {
        return json_encode(Norme::join('takmicenja','takmicenja.id','=','norme.takmicenje_naziv')->where('takmicenja.id','=',$request->id)->get(['norme.id','takmicenja.takmicenje','takmicenja.norme_informacije','norme.godiste','norme.norme_muski','norme.norme_zenski','norme.disciplina']));
    	}
    }
}
