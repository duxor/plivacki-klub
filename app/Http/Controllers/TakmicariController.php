<?php

namespace App\Http\Controllers;

use App\Http\Requests\DodajTakmicara;
use App\Stil;
use App\Takmicar;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class TakmicariController extends Controller
{
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
        if (!$takmicar_provera) $takmicar->slug = $slug;
        $takmicar->datum_rodjenja = date('Y-m-d H:i', strtotime($request->datum_rodjenja));
        $takmicar->foto = $putanja_slike;
        $takmicar->registracioni_broj = $request->registracioni_broj;
        $takmicar->opste_informacije = $request->opste_informacije;

        if ($takmicar_provera) {
            $takmicar->update();
            return Redirect::to('takmicari/takmicar/'.$takmicar->slug)->with('poruka', 'Uspešno ste izvršili ažuriranje');
        } else {
            $takmicar->save();
            return Redirect::to('takmicari/takmicar/'.$takmicar->slug)->with('poruka', 'Uspešno sta dodali novog takmičara');
        }

    }

    //Pikaz forme za azuriranje takmicara
    public function getTakmicar($slug){
       $takmicar = Takmicar::where('slug',$slug)->first();
      return view('takmicari.dodaj-takmicara')->with('takmicar',$takmicar);
    }
    public function postTakmicar(DodajTakmicara $request, $slug){
       return $this->postDodajTakmicara($request, $slug);
    }
    //Brisanje takmicara
    public function getUkloni(){
        return "izmeni takimcara";
    }


    public function postRekord(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                "result" => $request->vreme
            ]);
        }else{
           
        }

    }
}
