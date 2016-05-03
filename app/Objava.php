<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objava extends Model{
    protected $table='objava';
    protected $fillable=['naslov','slug','foto','sadrzaj','dodaci','datum','prioritet','mesto','galerija'];
    public static $readMore='<p><hr></p>';
    public static $numSlides=5;
    public static $brojObjavaNaPocetnoj=5;
    public static function getObjaveSkraceno($takmicenja=null,$brojObjava=null){
        $objave=$takmicenja?
            Objava::where('slug','<>','o-nama')
                ->whereNotNull('mesto')->orderBy('datum')->uzmi_prvih($brojObjava)->get(['naslov','slug','foto','sadrzaj','datum','mesto'])
            :
            Objava::where('slug','<>','o-nama')
                ->orderBy('id','desc')->uzmi_prvih($brojObjava)->get(['naslov','slug','foto','sadrzaj']);
        foreach($objave as $i=>$objava){
            $pozicija=strpos($objava->sadrzaj,Objava::$readMore);
            if($pozicija>0) $objave[$i]['sadrzaj']=substr($objava->sadrzaj,0,$pozicija);
            if($takmicenja) $objave[$i]['datum']=date('d.m.Y H:i',strtotime($objava['datum']));
        }
        return $objave;
    }
    public function scopeUzmi_prvih($query,$broj){
        return $broj?$query->take($broj):$query;
    }
    public static function getObjaveZaPocetnu(){
        return Objava::getObjaveSkraceno(null,Objava::$brojObjavaNaPocetnoj);
    }
    public static function getSlajder(){
        return Objava::where('prioritet',1)->orderBy('id','desc')->take(Objava::$numSlides)->get(['naslov','slug','foto']);
    }
    public static function dajObjavu($slug){
        $objava=Objava::where('slug',$slug)->get()->first();
        $objava->datum=$objava->datum?date('d.m.Y. H:i', strtotime($objava->datum)):null;
        $objava->dodaci=json_decode($objava->dodaci);
        return $objava;
    }
    public static function getKalendar(){
        $takmicenja=Objava::getObjaveSkraceno(true);
        $test=true; $danasnji=date('Y-m-d');
        $kalendar='{';
        foreach($takmicenja as $k=>$takmicenje){
            if(!strstr($kalendar,date('Y-m-d', strtotime($takmicenje->datum)))) $kalendar .= '"' . date('Y-m-d', strtotime($takmicenje->datum)) . '":{"number": "' . substr($takmicenje->naslov, 0, 20) . '...","badgeClass":"badge-warning","id": "#' . $takmicenje->slug . '","class": "active scrol","aclass":"kalendar-a"},';
            if($danasnji==date('Y-m-d', strtotime($takmicenje->datum))) $test=false;
        }
        if(!strstr($kalendar,date('Y-m-d'))) $kalendar .= ($test?'"'.date('Y-m-d').'":{"number":"","badgeClass":"badge-danger","class":"active-danger kalendar-dan "}':'').'}';
        return ['takmicenja'=>$takmicenja, 'kalendar'=>$kalendar];
    }
    public static function getGalerije(){
        return Objava::whereNotNull('galerija')->get(['naslov','foto','galerija']);
    }
}