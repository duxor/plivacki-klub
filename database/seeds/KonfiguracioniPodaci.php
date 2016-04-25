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
        Stil::insert(['naziv'=>'50m Kraul','naziv'=>'100m Kraul']);
        Takmicar::insert(['ime'=>'Aleksandar','prezime'=>'Jovic','slug'=>'jovic-aleksandar-0', 'datum_rodjenja'=>'2016-04-23','registracioni_broj'=>'21651as6das5d16as']);
        Rekord::insert(['takmicar_id'=>1,'stil_id'=>1, 'najbolje_vreme' => '15:30:12' ]);
    }
}
