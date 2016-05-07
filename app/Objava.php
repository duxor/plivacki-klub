<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objava extends Model{
    protected $table='objava';
    protected $fillable=['naslov','slug','foto','sadrzaj','dodaci','datum','prioritet','mesto','galerija'];
    public static $readMore='<p><hr></p>';
    public static $numSlides=5;
    public static $brojObjavaNaPocetnoj=5;
    public static $brObjavaNaStranici=9;
    public static function getObjaveSkraceno($takmicenja=null,$brojObjava=null,$stranica=null,$sadrzaj=null,$tekuci=null){
        $objave=Objava::where('slug','<>','o-nama');
        $polja=['naslov','slug','foto'];
        if($takmicenja){
            $polja=array_merge($polja,['sadrzaj','mesto','datum']);
            $objave=$objave->whereNotNull('mesto')->orderBy('datum');
            if($tekuci) $objave->where('datum','like','%-'.str_pad(date('m'),2,'0',STR_PAD_LEFT).'-%');
        }else{
            if(!$sadrzaj) array_push($polja,'sadrzaj');
            $objave=$objave->orderBy('id','desc');
        }
        $objave=$objave->stranica($stranica)
            ->uzmi_prvih($brojObjava)
            ->get($polja);
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
    public function scopeStranica($query,$broj){
        return $broj?$query->skip($broj*Objava::$brObjavaNaStranici):$query;
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
        $kalendar='[';
        foreach($takmicenja as $k=>$takmicenje){
            if(!strstr($kalendar,date('Y-m-d', strtotime($takmicenje->datum))))
                $kalendar .= "{
                        id: {$k},
                        naslov: '{$takmicenje->naslov}',
                        mesto: '{$takmicenje->mesto}',
                        vreme: '".date('H:i',strtotime($takmicenje->datum))."',
                        startDate: new Date(".date('Y, m, d',strtotime($takmicenje->datum))."),
                        endDate:  new Date(".date('Y, m, d',strtotime($takmicenje->datum)).")
                    },";
        }
        $kalendar.=']';
        return ['takmicenja'=>$takmicenja, 'kalendar'=>$kalendar];
    }
    public static function getKalendarZaTekuci(){
        $takmicenja=Objava::getObjaveSkraceno(true,null,null,true,true);
        $test=true;
        $danasnji=date('Y-m-d');
        $kalendar='{';
        foreach($takmicenja as $k=>$takmicenje){
            if(!strstr($kalendar,date('Y-m-d', strtotime($takmicenje->datum)))) $kalendar .= '"' . date('Y-m-d', strtotime($takmicenje->datum)) . '":{"number": "","badgeClass":"badge-warning","id": "#' . $takmicenje->slug . '","class": "","aclass":"kalendar-a","title":"' . $takmicenje->naslov . '","slug":"' . $takmicenje->slug . '"},';
            if($danasnji==date('Y-m-d', strtotime($takmicenje->datum))) $test=false;
        }
        if(!strstr($kalendar,date('Y-m-d'))) $kalendar .= ($test?'"'.date('Y-m-d').'":{"number":"","badgeClass":"badge-danger","class":"active-danger kalendar-dan "}':'').'}';
        return $kalendar;
    }
    public static function getGalerije(){
        return Objava::whereNotNull('galerija')->get(['naslov','foto','galerija']);
    }
    public static function ucitajStranicu($stranica=null){
        return [
            'objave'=>Objava::getObjaveSkraceno(null,Objava::$brObjavaNaStranici,$stranica),
            'brojStranica'=>ceil(Objava::where('slug','<>','o-nama')->count()/Objava::$brObjavaNaStranici)
        ];
    }
    public static function ukloni($slug){
        Objava::where('slug',$slug)->delete();
        return redirect('/vesti');
    }
}