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

    		$konacniPodaci=$podaci->except(['_token','update_norme','norme_id','stil','norme_informacije']);
            $konacniPodaci['takmicenje_naziv']=$podaci->get('takmicenje_naziv');
            $konacniPodaci['godiste']=$podaci->get('godiste');
            $konacniPodaci['stil_id']=$podaci->get('stil');
            $konacniPodaci['norme_zenski']=date('Y-m-d H:i',strtotime($podaci->get('norme_zenski')));
            $konacniPodaci['norme_muski']=date('Y-m-d H:i',strtotime($podaci->get('norme_muski')));


        if($podaci['update_norme']==1){
            /*$id=$podaci->get('rezultati_id');
            Norme::where('id',$id)->update($konacniPodaci);
            $naziv_takmicenjalists=Objava::lists('naslov','id');
        $naziv_takmicenja=Norme::join('objava','objava.id','=','norme.takmicenje_naziv')->groupBy('norme.takmicenje_naziv')->get(['objava.naslov','objava.id'])->toArray();
            return view('admin.dodaj-norme',['stil' => $stil,'naziv_takmicenja'=>$naziv_takmicenja,'naziv_takmicenjalists'=>$naziv_takmicenjalists])->with('uspesnoDodavanje',$podaci['update_rezultati']?'Uspešno ste izvršili azuriranje!':'Uspešno ste izvršili izmenu normi!');
*/
        }elseif($podaci->get('norme_informacije')){
            $id_info = DB::table('norme_info')->insertGetId(['norme_informacije' => $podaci->get('norme_informacije')]);
            $konacniPodaci['norme_info_id']=$id_info;
            Norme::insert([$konacniPodaci]);
            return Redirect::to('/norme/dodaj-norme');
        }else
            Norme::insert([$konacniPodaci]);
        return Redirect::to('/norme/dodaj-norme');
    }
    public function postUcitajRezultate(Request $request){
    	if ($request->ajax()) {
           $norme= Norme::leftJoin('norme_info','norme_info.id','=','norme.norme_info_id')->join('stil','stil.id','=','norme.stil_id')->where('norme.takmicenje_naziv','=',$request->id)->get();
            return json_encode($norme);
    	}
    }
    public function getObrisiNormu($id){
        Norme::where('takmicenje_naziv','=',$id)->delete();
        return Redirect::to('/norme/dodaj-norme');
    }
}
