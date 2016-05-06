<?php

use App\Objava;
use App\Rekord;
use App\Stil;
use App\Takmicar;
use Illuminate\Database\Seeder;
use App\User as Korisnici;

class TestPodaciSveVezanoZaObjave extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $brojTestObjava=30;//<<<<<<<<<<<<
        $duzinaNaslovaBrojRijeci=5;
        $duzinaSadrzajaBrojRijeci=40;
        $randomFotografije=[
            'http://racewheeltraders.com/wp-content/uploads/2015/10/swimmer_swimming_pool_night_79962_3840x2400.jpg',
            'https://dncache-mauganscorp.netdna-ssl.com/thumbseg/1301/1301177-bigthumbnail.jpg',
            'http://www.bhmpics.com/thumbs/sport_swimmer-t3.jpg',
            'https://www.whatsupgurgaon.in/awn-admin/uploaded_file/0_1414495960.jpg',
            'http://digitalresult.com/wp-content/uploads/2015/08/swimming-pool-hd-wallpapers-48.jpeg',
            'https://wallpaperspal.com/wp-content/uploads/Polar-Bear-Swimming-Wallpaper.jpg',
            'http://4.bp.blogspot.com/-yzcLxVqy5ag/VJhclfir5zI/AAAAAAAAfRY/aAOMKtBY8Nc/s1600/China-ofertan-sesiones-fotos-prematrimonales_LRZIMA20141222_0008_11.gif',
            'http://www.onlinepersonaltrainer.es/wp-content/uploads/2015/04/Adelgazar-nadando-1.jpg',
            'http://www.borongaja.com/data_images/out/23/658839-synchronized-swimming-wallpaper.jpg',
            'https://s-media-cache-ak0.pinimg.com/736x/9a/28/7f/9a287ff7ed7ed6b71eb3e8b07d62bb9c.jpg',
            'http://www.fonstola.ru/large/201309/111183.jpg',
            'http://www.3d-hdwallpaper.com/bulk_images2/images-of-children-swimming-hd-wallpaper.jpg'
        ];
        $brojRandomFotografija=sizeof($randomFotografije);
        $randomText='Plivanje je aktivnost kretanja živih bića kroz vodu koja uključuje održavanje na površini vode i kretanje u željenom smeru. Za razliku od ronjenja kod kojeg se kretanje odigrava potpuno ispod površine vode, kod plivanja je moguće normalno disanje, odnosno održavanjem na vodi plivač osigurava da je organ za disanje, kod čoveka nos i usta, iznad vode prilikom udisaja. Plivanje je česta rekreativna aktivnost ali i takmičarski sport. Iako je plivanje vrlo zdrava aktivnost, ukoliko plivač ne proceni dobro svoju veštinu i pripremljenost i ne uvaži uslove na vodi (moru, jezeru, reci i sl.) postoji stalna opasnost od davljenja, pa su stoga nužne mere opreza. Plivanje je poznato od praistorije. Crteži iz kamenog doba su pronađeni u tzv. „pećini plivača“ u okolini Vadi Sore (ili Sure) u jugozapadnom delu Egipta. Pisani pomen plivanja javlja se već od 2000. p. n. e., u epovima o Gilgamešu, Odiseji i Ilijadi. Plivanje je bio jedan od sportova prvih modernih Letnjih olimpijskih igara 1896. u Atini. Veći deo ljudskog tela (60%) je voda, i ono ima gustinu sličnu vodi. Kada su pluća puna vazduha, telo je nešto manje gustine nego voda koja ga okružuje, i na njega deluje potisak koji ga drži delimično van vode. Stoga je za ostajanje na površini potrebno samo blago guranje vode na dole relativno u odnosu na telo, i transverzalno kretanje koje se postiže korišćenjem šaka i nadlaktica kao vesala, kao i udaranje (šutiranje) nogama i stopalima ne bi li se voda odgurala od tela (mada samo šutiranje daje relativno mali potisak). Budući da je slana voda (na primer, okean) gušća od slatke vode (npr. većina bazena za plivanje), za ostajanje na površini u slanoj vodi potrebno je manje truda nego u slatkoj vodi. Profesionalni plivači koriste plivačke kostimime, koji su se zavisno o modnim kretanjima kroz istoriju bitno menjali, po obliku, materijalima i izgledu. Danas su najuobičajeniji jednodelni ili dvodelni kostimi usko pripijeni uz telo od laganih rastegljivih materijala, koji se često nazivaju i bikini. Uz plivačke kostime većinaplivača koristi i kapice za glavu od gume, silikona ili soecijalnog platna. Pojedina devojke i žene na manje konzervativnim plažama često skidaju gornji deo bikinija, i korsite tzv. toples varijantu (odnosno monokini). Takmičari na sportskim takmičenjima u želji da dostignu što manje trenje tela pri kretanju kroz vodu (i time naravno bolju brzinu i rezultat) koriste specifijalizovane plivačke kostime od izabranih materijala, koji ponekad tesno leže uz celo telo pa i glavu na principu kombinezona sa kapuljačom. Uz plivački kostime, plivači koriste i plivačke naočare, koje omogućavaju lagodnije gledanje u vodi, i ujeno štite organ vida od ozleda tokom dužeg boravka u hlorisanim bazenima.';
        $randomRijeci=explode(' ',$randomText);
        $brojRandomRijeci=sizeof($randomRijeci);

        for($i=0; $i<$brojTestObjava; $i++){
            $insert=[
                'naslov'=>'',
                'slug'=>'',
                'sadrzaj'=>'',
                'foto'=>null,
                'dodaci'=>null,
                'datum'=>null,
                'prioritet'=>0,
                'mesto'=>null,
                'galerija'=>null
            ];
            //NASLOV
            for($j=0; $j<$duzinaNaslovaBrojRijeci; $j++) $insert['naslov'].=$randomRijeci[rand(0,$brojRandomRijeci-1)].' ';
            //SLUG
            $tmp = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $insert['naslov']));
            if ($tmp[strlen($tmp) - 1] == '-') $tmp = substr($tmp, 0, strlen($tmp) - 1);
            $ii = 0;
            while (!$insert['slug']) {
                if (!Objava::where('slug', $tmp . ($ii == 0 ? '' : '-' . $ii))->exists()) $insert['slug'] = $tmp . ($ii == 0 ? '' : '-' . $ii);
                $ii++;
            }
            //SADRZAJ
            for($j=0; $j<$duzinaSadrzajaBrojRijeci; $j++) $insert['sadrzaj'].=$randomRijeci[rand(0,$brojRandomRijeci-1)].' ';
            //FOTO
            $insert['foto']=$randomFotografije[rand(0,$brojRandomFotografija-1)];
            //DATUM
            if(rand(0,1)==1){
                $insert['mesto']=strtoupper($randomRijeci[rand(0,$brojRandomRijeci-1)]);
                $insert['datum']='2016-04-'.rand(0,31);
            }
            $insert['prioritet']=rand(0,1);
            Objava::insert([$insert]);
        }
    }
}
