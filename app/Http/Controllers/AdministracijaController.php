<?php

namespace App\Http\Controllers;

use App\Funkcije;
use App\Http\Requests\DodajObjavu;
use Illuminate\Support\Facades\Redirect;
use App\Objava;
use App\Rezultati;

class AdministracijaController extends Controller{
    private $imgFolder='img/objava';
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
            Funkcije::kreirajSlug($podaci['naslov'],new Objava());
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
            ->with('uspesnoDodavanje',$editMsg?$editMsg:
                ('Uspešno ste izvršili dodavanje nov'.($podaci->exists('mesto')?'og takmičenja':'e objave.'))
            )
            ->with('slugEdit',$_slug?($konacniPodaci['slug']==$_slug?0:1):0);
    }
    public function getObjava($slug){
        return view('admin.dodaj-objavu')->with('objava',Objava::where('slug',$slug)->get()->first());
    }
    public function postObjava($slug,DodajObjavu $request){
        return $this->postDodajObjavu($request, 'Uspešno ste ažurirali postojeću objavu.',$slug);
    }


    



}