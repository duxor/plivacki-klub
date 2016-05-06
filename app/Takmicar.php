<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Takmicar extends Model
{
    protected $table='takmicar';
    protected $fillable=['ime','prezime', 'datum_rodjenja', 'foto','registracioni_broj', 'opste_informacije'];
    public static $brojTakmicaraNaPocetnoj=5;

    public static function takmicariZaPocetnu(){
        return Takmicar::orderBy('id','desc')->take(Takmicar::$brojTakmicaraNaPocetnoj)->get(['ime','prezime','slug','foto']);
    }
}
