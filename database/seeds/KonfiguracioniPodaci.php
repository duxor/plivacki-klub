<?php

use App\Objava;
use App\Rekord;
use App\Stil;
use App\Takmicar;
use Illuminate\Database\Seeder;
use App\User as Korisnici;

class KonfiguracioniPodaci extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Korisnici::insert(['ime'=>'admin','username'=>'admin','password'=>bcrypt('admin'),'email'=>'admin@gmail.com']);
        Objava::insert(['naslov'=>'O nama','slug'=>'o-nama']);
        Stil::insert([
            ['naziv'=>'50 slobodno'],
            ['naziv'=>'100 slobodno'],
            ['naziv'=>'200 slobodno'],
            ['naziv'=>'400 slobodno'],
            ['naziv'=>'800 slobodno'],
            ['naziv'=>'1500 slobodno'],
            ['naziv'=>'50 ledjno'],
            ['naziv'=>'100 ledjno'],
            ['naziv'=>'200 ledjno'],
            ['naziv'=>'50 prsno'],
            ['naziv'=>'100 prsno'],
            ['naziv'=>'200 prsno'],
            ['naziv'=>'50 delfin'],
            ['naziv'=>'100 delfin'],
            ['naziv'=>'200 delfin'],
            ['naziv'=>'200 mesovito'],
            ['naziv'=>'400 mesovito']
        ]);
        Takmicar::insert(['ime'=>'Aleksandar','prezime'=>'Jovic','slug'=>'jovic-aleksandar-0', 'datum_rodjenja'=>'2016-04-23','registracioni_broj'=>'21651as6das5d16as']);
        Rekord::insert(['takmicar_id'=>1,'stil_id'=>1, 'najbolje_vreme' => '15:30:12' ]);
    }
}
