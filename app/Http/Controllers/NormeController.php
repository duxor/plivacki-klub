<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Norme;

class NormeController extends Controller
{
    public function getIndex(){
        $norme=Norme::all();
        return view('norme',compact('norme'));
    }
    public function getDodajNorme(){
        return view('admin.dodaj-norme');
    }
}
