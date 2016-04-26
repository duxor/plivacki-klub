<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Norme extends Model
{
    protected $table='norme';
    protected $fillable=['godiste','pol','disciplina','vreme','norme_informacije'];

}
