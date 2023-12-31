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
        Schema::create('orang_tua', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger('user_id');
            $table->string('nik', 16);
            $table->string('nama');
            $table->string('jenis_kelamin', 10);
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('telepon')->nullable();
            $table->string('alamat_lengkap')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orang_tua');
    }
};
