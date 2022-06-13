<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenangDatang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benang_datang', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_benang');
            $table->string('warna_benang');
            $table->float('jumlah_benang');
            $table->string('satuan');
            $table->dateTime('tgl_benang_datang');
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
        Schema::dropIfExists('benang_datang');
    }
}
