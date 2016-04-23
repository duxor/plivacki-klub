<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekord extends Model
{
    protected $table='rekord';
    protected $fillable=['takmicar_id','stil_id', 'najbolje_vreme'];
}
