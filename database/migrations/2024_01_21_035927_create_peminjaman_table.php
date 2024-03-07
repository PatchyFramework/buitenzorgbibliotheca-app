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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->bigIncrements('PeminjamanID');

            $table->unsignedBigInteger('userid');
            $table->foreign('userid')->references('userid')->on('user');
            
            $table->unsignedBigInteger('BukuID');
            $table->foreign('BukuID')->references('BukuID')->on('buku');

            $table->dateTime('TanggalPeminjaman', $precision = 0);
            $table->dateTime('TanggalPengembalian', $precision = 0);

            $table->enum('StatusPeminjaman', ['Masa Aktif', 'Kedaluwarsa', 'Dikembalikan']);

            $table->string('Denda')->nullable();

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
        Schema::dropIfExists('peminjaman');
    }
};
