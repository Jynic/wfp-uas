<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_staff', function (Blueprint $table) {
            $table->id('idm_staff');
            $table->unsignedBigInteger('iddinas');
            $table->unsignedBigInteger('idjabatan');
            $table->text('nama')->nullable();
            $table->text('username')->nullable();
            $table->text('password')->nullable();
            $table->integer('status_aktif')->default(1);
            $table->text('alamat')->nullable();
            $table->text('email')->nullable();
            $table->unsignedBigInteger('idkota_kabupaten')->nullable();

            $table->foreign('iddinas')->references('iddinas')->on('m_dinas');
            $table->foreign('idjabatan')->references('idjabatan')->on('m_jabatan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_staff');
    }
};
