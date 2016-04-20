<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objava extends Model{
    protected $table='objava';
    protected $fillable=['naslov','slug','foto','sadrzaj','dodaci','datum','prioritet'];
    public static $readMore='<p><hr></p>';
    public static $numSlides=5;
    public static function getObjaveSkraceno(){
        $objave=Objava::get(['naslov','slug','foto','sadrzaj']);
        foreach($objave as $i=>$objava){
            $pozicija=strpos($objava->sadrzaj,Objava::$readMore);
            if($pozicija>0) $objave[$i]['sadrzaj']=substr($objava->sadrzaj,0,$pozicija);
        }
        return $objave;
    }
    public static function getSlajder(){
        return Objava::where('prioritet',1)->take(Objava::$numSlides)->get(['naslov','slug','foto']);
    }
}