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
    }

 
    public function down()
    {
        Schema::drop('korisnici');
        Schema::drop('password_resets');
    }
}
