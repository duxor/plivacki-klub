<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Rezultati;

class RezultatiController extends Controller{

    public function getIndex(){

        $rezultati=Rezultati::all();
        return view('rezultati',compact('rezultati'));
    }
}