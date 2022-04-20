<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangDatang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_datang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_benang_id');
            $table->foreignId('warna_benang_id');
            $table->integer('jumlah_benang');
            $table->foreignId('satuan_id');
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
        Schema::dropIfExists('barang_datang');
    }
}
