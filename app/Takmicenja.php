<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Takmicenja extends Model
{
     protected $table='takmicenja';
    protected $fillable=['takmicenje','norme_informacije'];

}
