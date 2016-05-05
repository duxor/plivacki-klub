<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KreiranjeBaze extends Migration
{
 
    public function up()
    {
        Schema::create('korisnici', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ime', 45);
            $table->string('username', 45)->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });
        Schema::create('objava', function (Blueprint $table) {
            $table->increments('id');
            $table->string('naslov',150);
            $table->string('slug',250);
            $table->string('foto',250)->nullable();
            $table->text('sadrzaj')->nullable();
            $table->text('dodaci')->nullable();
            $table->string('mesto',250)->nullable();
            $table->string('galerija',250)->nullable();
            $table->timestamp('datum')->nullable();
            $table->tinyInteger('prioritet')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('rezultati',function(Blueprint $table){
            $table->increments('id');
            $table->string('takmicenje_naziv', 128);
            $table->string('mesto',45);
            $table->dateTime('datum')->nullable();
            $table->string('klupski_rezultati',128);
            $table->string('sumarni_rezultati',128);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('takmicar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ime',45);
            $table->string('prezime',45);
            $table->string('slug',250);
            $table->timestamp('datum_rodjenja');
            $table->string('foto',250)->nullable();
            $table->string('registracioni_broj',45);
            $table->text('opste_informacije')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('stil', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('naziv', 45)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('rekord', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('takmicar_id');
            $table->foreign('takmicar_id')->references('id')->on('takmicar');
            $table->unsignedBigInteger('stil_id');
            $table->foreign('stil_id')->references('id')->on('stil');
            $table->time('najbolje_vreme');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
         Schema::create('norme', function (Blueprint $table) {
             $table->increments('id');

             $table->unsignedInteger('takmicenje_naziv');
             $table->foreign('takmicenje_naziv')->references('id')->on('objava');

             $table->unsignedBigInteger('stil_id');
             $table->foreign('stil_id')->references('id')->on('stil');

             $table->integer('godiste');
             $table->time('norme_muski');
             $table->time('norme_zenski');
             $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
             $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('korisnici');
        Schema::drop('password_resets');
        Schema::drop('objava');
        Schema::drop('rezultati');
        Schema::drop('rekord');
        Schema::drop('takmicar');
        Schema::drop('stil');
        Schema::drop('norme');
    }
}
