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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('universitas');
            $table->enum('kategori_lomba', ['Arjuna', 'Kresna', 'Prahasta', 'Nakula', 'Sadewa']);
            $table->enum('lomba', ['Homeless Media', 'Comic Strip', 'Podcast', 'Film Fiksi', 'Movie Scoring', 'Film Dokumenter', 'Penulisan Naskah', 'PR Campaign', 'Press Conference', 'Risk Management', 'Riset Strategis Akademik', 'Fun Research', 'Social Media Activation', 'Unconventional Media', 'Brandbook', 'Skip Ad']);
            $table->string('path_bukti_bayar')->nullable();
            $table->string('path_file_lomba')->nullable();
            $table->boolean('validasi_pembayaran')->default(false);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('ketua_id')->nullable();            
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
