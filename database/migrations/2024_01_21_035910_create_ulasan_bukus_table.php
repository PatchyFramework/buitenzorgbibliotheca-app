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
        Schema::create('ulasanbuku', function (Blueprint $table) {
            $table->bigIncrements('UlasanID');

            $table->unsignedBigInteger('userid');
            $table->foreign('userid')->references('userid')->on('user');
            
            $table->unsignedBigInteger('BukuID');
            $table->foreign('BukuID')->references('BukuID')->on('buku');

            $table->text('Ulasan');
            $table->decimal('Rating', $precision = 10, $scale = 1);

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
        Schema::dropIfExists('ulasanbuku');
    }
};
