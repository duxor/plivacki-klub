<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objava extends Model{
    protected $table='objava';
    protected $fillable=['naslov','slug','foto','sadrzaj','dodaci','datum','prioritet'];
}