<?php

namespace App\Http\Controllers;

use App\DuzinaBazena;
use App\Http\Requests\DodajTakmicara;
use App\Pol;
use App\Rekord;
use App\Stil;
use App\Takmicar;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TakmicariController extends Controller
{
  /*  public function __construct(){
        $this->middleware('auth');
    }*/
    //Prikaz svih takmicara
    public function getIndex(){
            $takmicari = Takmicar::all();
            return view('takmicari.index')->with('takmicari',$takmicari);
    }
    

    //Prikaz forme za dodavanje takmicara
    public function getDodajTakmicara(){
        $stilovi = Stil::lists('naziv','id');
        return view('takmicari.dodaj-takmicara')->with('stilovi',$stilovi);
    }

    //Dodavanje novog i azuriranje postojeceg takmicara
    public function postDodajTakmicara(DodajTakmicara $request, $_slug=null)
    {

        //Foto
        if ($request->foto) {
            $naziv_slike = $request->foto->getClientOriginalName();
            $request->foto->move('img/takmicari', $naziv_slike);
            $putanja_slike = '/img/takmicari/' . $naziv_slike;
        } elseif ($request->foto_pomocna != '') {
            $putanja_slike = $request->foto_pomocna;
        } else {
            $putanja_slike = '/img/takmicari/foto-takmicari.jpg';
        }

        //Slug
        $tmp = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $request->ime . '-' . $request->prezime));
        $i = 0;
        $x = true;
        while ($x) {
            if ($a = Takmicar::where('slug', $tmp . ($i == 0 ? '' : ('-' . ($i - 1))))->exists() == 1) {
                $i = $i + 1;
                $x = true;
            } else {
                $x = false;
            }
        }
        $slug = $tmp . ($i == 0 ? '' : ('-' . ($i - 1)));
        //Provera insert ili updat
        $takmicar_provera = Takmicar::where('slug', $_slug)->get()->first();
        if ($takmicar_provera)
            $takmicar = $takmicar_provera;
        else
            $takmicar = new Takmicar();
        //Unosenje podataka
        $takmicar->ime = $request->ime;
        $takmicar->prezime = $request->prezime;
        $takmicar->pol_id = $request->pol_id;
        if (!$takmicar_provera) $takmicar->slug = $slug;
        $takmicar->datum_rodjenja = date('Y-m-d H:i', strtotime($request->datum_rodjenja));
        $takmicar->foto = $putanja_slike;
        $takmicar->registracioni_broj = $request->registracioni_broj;
        $takmicar->opste_informacije = $request->opste_informacije;

        if ($takmicar_provera) {
            $takmicar->update();
            return Redirect::to('takmicari/izmeni/'.$takmicar->slug)->with('poruka', 'Uspešno ste izvršili ažuriranje');
        } else {
            $takmicar->save();
            return Redirect::to('takmicari/izmeni/'.$takmicar->slug)->with('poruka', 'Uspešno sta dodali novog takmičara');
        }

    }

    //Pikaz forme za azuriranje takmicara
    public function getIzmeni($slug){
       $takmicar = Takmicar::where('slug',$slug)->first();
        $stilovi = Stil::lists('naziv','id');
        $duzina_bazena = DuzinaBazena::lists('naziv','id');
      return view('takmicari.dodaj-takmicara')->with('takmicar',$takmicar)->with('stilovi',$stilovi)->with('duzina_bazena',$duzina_bazena);
    }
    public function postIzmeni(DodajTakmicara $request, $slug){
       return $this->postDodajTakmicara($request, $slug);
    }
    //Brisanje takmicara
    public function getUkloni($slug){
        Takmicar::where('slug','=',$slug)->delete();
        return Redirect::to('/takmicari');
    }

    //Funkcija za prikazivanje rekorda u tabeli
    public function postRekordi(Request $request)
    {
        if ($request->ajax()) {
            $rekordi = DB::table('rekord')
                ->join('takmicar', 'rekord.takmicar_id','=','takmicar.id')
                ->join('stil', 'rekord.stil_id','=','stil.id')
                ->where('rekord.takmicar_id','=',$request->takmicar_id)
                ->select('rekord.id as id','stil.naziv as stil','rekord.najbolje_vreme as najbolje_vreme')
                ->get();
            return json_encode($rekordi);
        }
    }

    //Funkcija za sminanje rekorda
    public function postRekord(Request $request)
    {
         if ($request->ajax()) {

            $rekord = new Rekord();
            $rekord->takmicar_id = $request->takmicar_id;
            $rekord->stil_id = $request->stil_id;
            $rekord->najbolje_vreme = $request->vreme;
             $rekord->duzina_bazena_id = $request->duzina_bazena_id;
            $rekord->save();

             $rekordi = DB::table('rekord')
                 ->join('takmicar', 'rekord.takmicar_id','=','takmicar.id')
                 ->join('stil', 'rekord.stil_id','=','stil.id')
                 ->where('rekord.takmicar_id','=',$request->takmicar_id)
                 ->select('rekord.id as id','stil.naziv as stil','rekord.najbolje_vreme as najbolje_vreme')
                 ->get();

             return json_encode($rekordi);
        }

    }

    //Funkcija za prikazivanje rekorda u tabeli
    public function postObrisiRekord(Request $request)
    {
        if ($request->ajax()) {
            Rekord::destroy($request->rekord_id);
        }
    }


    public function FormaRekordi()
    {
        $stilovi = Stil::lists('naziv','id');
        $pol = Pol::lists('naziv','id');
        $duzina_bazena = DuzinaBazena::lists('naziv','id');
        return view('takmicari.rekordi')->with('stilovi',$stilovi)->with('pol',$pol)->with('duzina_bazena',$duzina_bazena);
    }


    public function TabelaRekordi(Request $request)
    {
        if ($request->ajax()) {

            $rekordi = DB::table('rekord')
                ->join('takmicar', 'rekord.takmicar_id','=','takmicar.id')
                ->join('stil', 'rekord.stil_id','=','stil.id')
                ->join('duzina_bazena','rekord.duzina_bazena_id', '=','duzina_bazena.id')
                ->where('rekord.duzina_bazena_id','=',$request->duzina_bazena_id)
                ->where('takmicar.pol_id','=',$request->pol_id)
                ->where('rekord.stil_id','=',$request->stil_id)
                ->orderBy('rekord.najbolje_vreme')
                ->select('takmicar.ime as ime','takmicar.prezime as prezime', 'takmicar.datum_rodjenja as godiste', 'rekord.najbolje_vreme as najbolje_vreme' )
                ->get();

            return json_encode($rekordi);
        }
    }
}
