<?php

namespace App\Http\Controllers;

use App\Http\Requests\DodajObjavu;

class AdministracijaController extends Controller{
    public function __construct(){
        
    }
    public function getIndex(){
        return view('admin.index');
    }
    public function getDodajObjavu(){
        return view('admin.dodaj-objavu');
    }
    public function postDodajObjavu(DodajObjavu $podaci){

        dd($podaci);
    }
}