<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Takmicar extends Model
{
    protected $table='takmicar';
    protected $fillable=['ime','prezime', 'datum_rodjenja', 'foto','registracioni_broj', 'opste_informacije'];
}
