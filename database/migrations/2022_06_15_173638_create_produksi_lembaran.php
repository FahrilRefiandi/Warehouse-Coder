<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksiLembaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produksi_lembaran', function (Blueprint $table) {
            $table->id();
            $table->string('benang_datang_id');
            $table->integer('shift_kerja_id');
            $table->string('jumlah_pakai');
            $table->string('satuan');
            $table->integer('mesin_id');
            $table->string('motif');
            $table->string('perkiraan_lembar')->nullable();
            $table->date('tanggal_produksi');
            $table->date('tanggal_pengiriman')->nullable();
            $table->enum('status_pengiriman', ['Belum Dikirim', 'Terkirim'])->default('Belum Dikirim');
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
        Schema::dropIfExists('produksi_lembaran');
    }
}
