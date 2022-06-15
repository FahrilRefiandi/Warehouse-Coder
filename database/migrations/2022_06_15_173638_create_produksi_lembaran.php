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
            $table->string('jenis_benang');
            $table->string('warna_benang');
            $table->float('jumlah_pakai');
            $table->string('satuan');
            $table->foreignId('benang_datang_id');
            $table->string('kode_mesin');
            $table->string('motif');
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
