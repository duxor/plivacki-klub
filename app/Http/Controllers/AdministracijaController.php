<?php

namespace App\Http\Controllers;

class AdministracijaController extends Controller{
    public function __construct(){
        
    }
    public function getIndex(){
        return view('admin.index');
    }
    public function getDodajObjavu(){
        return view('admin.dodaj-objavu');
    }
    public function postDodajObjavu(){
        dd($_POST);
    }
}