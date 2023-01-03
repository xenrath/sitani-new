<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHargaPangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harga_pangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pangan_id');
            $table->foreign('pangan_id')->references('id')->on('pangans');
            $table->unsignedInteger('kategori');
            $table->foreign('kategori')->references('id')->on('kategori_pangans');
            $table->string('nama');
            $table->string('harga');
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
        Schema::dropIfExists('harga_pangans');
    }
}
