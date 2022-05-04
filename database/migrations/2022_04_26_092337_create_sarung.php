<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSarung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sarung', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sarung')->unique();
            $table->string('warna_sarung');
            $table->string('motif_sarung');
            $table->integer('stok_sarung');
            $table->string('satuan');
            $table->enum('status',['tersedia','terkirim']);
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
        Schema::dropIfExists('sarung');
    }
}
