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
        Schema::create('buku', function (Blueprint $table) {
            $table->bigIncrements('BukuID');

            $table->char('Barcode', 10);
            $table->string('Judul', 255);
            $table->string('Penulis', 255);
            $table->string('Penerbit', 255);
            $table->year('TahunTerbit');
            $table->text('Synopsis')->nullable();
            $table->integer('Stock');
            $table->enum('StatusKetersediaan', ['Tersedia', 'Tidak Tersedia']);
            $table->string('ImgBuku')->nullable();

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
        Schema::dropIfExists('buku');
    }
};
