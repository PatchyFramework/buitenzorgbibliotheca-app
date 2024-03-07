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
        Schema::create('users_verify', function (Blueprint $table) {
            $table->unsignedBigInteger('userid');
            $table->foreign('userid')->references('userid')->on('user');
            $table->string('token');
            $table->timestamps();
            $table->softDeletes();
        });
  
        Schema::table('user', function (Blueprint $table) {
            $table->boolean('email_verified_at')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_verify');
    }
};
