<?php

namespace App\Http\Controllers;

use App\Http\Requests\DodajObjavu;
use App\Http\Requests\DodajRezultat;
use Illuminate\Support\Facades\Redirect;
use Storage;
use App\Objava;
use App\Rezultati;

class AdministracijaController extends Controller{
    private $imgFolder='img/objava';
    private $rezultatiFolder='rezultati';
    public function __construct(){
        $this->middleware('auth');
    }
    public function getIndex(){
        return view('admin.index');
    }
    public function getDodajObjavu(){
        return view('admin.dodaj-objavu');
    }
    public function postDodajObjavu(DodajObjavu $podaci, $editMsg=null,$_slug=null){
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
        if($podaci->exists('naslov')) {
            // SLUG-KREATOR START::
            $slug = null;
            $tmp = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $podaci['naslov']));
            if ($tmp[strlen($tmp) - 1] == '-') $tmp = substr($tmp, 0, strlen($tmp) - 1);
            $i = 0;
            while (!$slug) {
                if (!Objava::where('slug', $tmp . ($i == 0 ? '' : '-' . $i))->exists()) $slug = $tmp . ($i == 0 ? '' : '-' . $i);
                $i++;
            }
            // SLUG-KREATOR END::
        }
        $konacniPodaci=$podaci->except(['_token','dodaci','foto','datum']);
        if($editMsg){
            $stariPodaci=Objava::where('slug',$_slug)->get(['foto','dodaci','datum','slug','naslov'])->first();
            if(!$dodaci) $konacniPodaci['dodaci']=$stariPodaci->dodaci;
            else $konacniPodaci['dodaci']=json_encode($dodaci);
            if(!$foto) $foto=$stariPodaci->foto;
            if($podaci['datum']) $konacniPodaci['datum']=date('Y-m-d H:i',strtotime($podaci->get('datum')));
            else $konacniPodaci['datum']=$stariPodaci->datum;
            if(!isset($konacniPodaci['prioritet'])) $konacniPodaci['prioritet']=0;
            if($stariPodaci->naslov==$konacniPodaci['naslov']) $slug=$stariPodaci->slug;
        }else{
            $konacniPodaci['dodaci']=json_encode($dodaci);
            $konacniPodaci['datum']=date('Y-m-d H:i',strtotime($podaci->get('datum')));
        }
        $konacniPodaci['foto']=$foto;
        $konacniPodaci['slug']=$slug;
        if($editMsg)
            Objava::where('slug',$_slug)->update($konacniPodaci);
        else
        Objava::insert([$konacniPodaci]);
        return view('admin.dodaj-objavu')
            ->with('objava',$editMsg?$konacniPodaci:null)
            ->with('uspesnoDodavanje',$editMsg?$editMsg:'Uspešno ste izvršili dodavanje nove objave.')
            ->with('slugEdit',$_slug?($konacniPodaci['slug']==$_slug?0:1):0);
    }
    public function getObjava($slug){
        return view('admin.dodaj-objavu')->with('objava',Objava::where('slug',$slug)->get()->first());
    }
    public function postObjava($slug,DodajObjavu $request){
        return $this->postDodajObjavu($request, 'Uspešno ste ažurirali postojeću objavu.',$slug);
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

        $konacniPodaci=$podaci->except(['_token']);
        $konacniPodaci['sumarni_rezultati']=$podaci->get('sumarni_rezultati');
        $konacniPodaci['klupski_rezultati']=$klupski_rezultati;
        $konacniPodaci['sumarni_rezultati']=$sumarni_rezultati;
        $konacniPodaci['datum']=date('Y-m-d H:i',strtotime($podaci->get('datum')));
        $konacniPodaci['mesto']=$podaci->get('mesto');



        if($editMsg)
           Rezultati::where('id',$id)->update($konacniPodaci);
        else
            Rezultati::insert([$konacniPodaci]);
        return view('admin.dodaj-rezultate')
            ->with('uspesnoDodavanje',$editMsg?$editMsg:'Uspešno ste izvršili dodavanje novog rezultata.')
            ->with('rezultati',$editMsg?$konacniPodaci:null);
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