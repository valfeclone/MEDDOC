<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->date('date_invocie');
            $table->string('dokter_phone');
            $table->enum('invoice_status', ['bayar', 'belum bayar']);
            $table->foreignId('user_id')->nullable();    
            $table->foreignId('dokter_id')->nullable();        
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
