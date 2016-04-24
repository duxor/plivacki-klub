<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rezultati extends Model
{
    protected $table='rezultati';
    protected $fillable=['takmicenje_naziv','datum','mesto','klupski rezultati','sumarni_rezultati','created_at'];
}
