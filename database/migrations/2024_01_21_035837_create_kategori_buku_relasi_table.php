<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategoribuku_relasi', function (Blueprint $table) {
            $table->bigIncrements('KategoriBukuID');

            $table->unsignedBigInteger('KategoriID');
            $table->foreign('KategoriID')->references('KategoriID')->on('kategoribuku');
            
            $table->unsignedBigInteger('BukuID');
            $table->foreign('BukuID')->references('BukuID')->on('buku');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategoribuku_relasi');
    }
};
