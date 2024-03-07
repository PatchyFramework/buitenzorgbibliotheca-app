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
        Schema::create('koleksi_pribadi_buku', function (Blueprint $table) {
            $table->unsignedBigInteger('KoleksiPribadiID');
            $table->foreign('KoleksiPribadiID')->references('KoleksiID')->on('koleksipribadi')->onDelete('cascade');
        
            $table->unsignedBigInteger('BukuID');
            $table->foreign('BukuID')->references('BukuID')->on('buku')->onDelete('cascade');
        
            $table->timestamps();
        
            $table->primary(['KoleksiPribadiID', 'BukuID']);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('koleksi_pribadi_buku');
        
    }
};
