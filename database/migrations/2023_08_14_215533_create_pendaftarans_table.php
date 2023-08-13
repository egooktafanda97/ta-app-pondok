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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger('user_pendaftar_id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('orang_tua_id');
            $table->string('tahun_ajaran', 20);
            $table->string('asal_sekolah', 20);
            $table->string('metode_pendaftaran', 20);
            $table->text('lampiran');
            $table->string('status', 20);
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswa');
            $table->foreign('orang_tua_id')->references('id')->on('orang_tua');
            $table->foreign('user_pendaftar_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
};
