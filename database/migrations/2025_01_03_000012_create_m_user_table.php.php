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
            $table->unsignedBigInteger('idkota_kabupaten')->nullable();
            $table->unsignedBigInteger('idjabatan')->default('2');
            $table->text('nama');
            $table->text('username')->unique();
            $table->text('password');
            $table->text('alamat')->nullable();
            $table->text('no_hp')->nullable();
            $table->text('email')->nullable()->unique();
            $table->integer('status_aktif')->default(1);
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
