<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_user', function (Blueprint $table) {
            $table->id('iduser');
            $table->unsignedBigInteger('idkota_kabupaten');
            $table->unsignedBigInteger('idjabatan');
            $table->text('nama')->nullable();
            $table->text('username')->nullable();
            $table->text('password')->nullable();
            $table->text('alamat')->nullable();
            $table->text('no_hp')->nullable();
            $table->text('email')->nullable();
            $table->integer('status_aktif')->nullable();
            $table->unsignedBigInteger('idstaff')->nullable();

            $table->foreign('idjabatan')->references('idjabatan')->on('m_jabatan');
            $table->foreign('idkota_kabupaten')->references('idkota_kabupaten')->on('m_kota_kabupaten');
            $table->foreign('idstaff')->references('idm_staff')->on('m_staff');
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_user');
    }
};
