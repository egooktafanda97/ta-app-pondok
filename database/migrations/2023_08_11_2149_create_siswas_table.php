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
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('orang_tua_id');
            $table->string('nis', 30)->unique();
            $table->string('nama_lengkap', 200);
            $table->string('jenis_kelamin', 10);
            $table->string('tempat_lahir', 150);
            $table->date('tanggal_lahir');
            $table->string('agama', 20);
            $table->text('alamat_lengkap')->nullable();
            $table->string('status_siswa', 10)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('orang_tua_id')->references('id')->on('orang_tua');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
};
