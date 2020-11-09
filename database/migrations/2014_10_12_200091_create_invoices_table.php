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
            $table->date('date_invoice');
            $table->foreignId('dokter_phone')->references('dokter_phone')->on('dokter'); 
            $table->enum('invoice_status', ['belum diambil', 'diambil', 'selesai', 'batal']);
            $table->foreignId('user_id')->references('user_id')->on('users');    
            $table->foreignId('dokter_id')->references('dokter_id')->on('dokter');       
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
        Schema::dropIfExists('invoice');
    }
}
