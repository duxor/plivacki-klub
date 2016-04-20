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
            $table->text('dodaci');
            $table->timestamp('datum')->nullable();
            $table->tinyInteger('prioritet')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();;
        });
    }

 
    public function down()
    {
        Schema::drop('korisnici');
        Schema::drop('password_resets');
        Schema::drop('objava');
    }
}
