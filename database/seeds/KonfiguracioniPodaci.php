<?php

use App\Objava;
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
    }
}
