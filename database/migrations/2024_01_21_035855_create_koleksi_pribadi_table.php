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
        Schema::create('koleksipribadi', function (Blueprint $table) {
            $table->bigIncrements('KoleksiID');

            $table->string('NamaKoleksi');

            $table->string('ImgKoleksi')->nullable();

            $table->unsignedBigInteger('userid');
            $table->foreign('userid')->references('userid')->on('user');
            

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
        Schema::dropIfExists('koleksipribadi');
    }
};
