<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->id('dokter_id');
            $table->string('dokter_name');
            $table->string('dokter_phone');
            $table->string('path_izin_praktik');
            $table->boolean('status_izin_praktek')->default(false);
            $table->string('email_dokter')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();           
            //yang bawah ini ga gw apus gara gara tar ribet errornya
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            //yang atas ga gw apus gr gr ribet
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
