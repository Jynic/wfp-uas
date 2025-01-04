<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('t_pelaporan', function (Blueprint $table) {
            $table->id('idpelaporan');
            $table->text('nomor')->nullable();
            $table->datetime('tgl_pelaporan')->nullable();
            $table->unsignedBigInteger('idm_staff');
            $table->unsignedBigInteger('iduser');
            $table->text('status_pelaporan')->comment("'Antri', 'Dikerjakan', 'Outsource','Selesai','Tidak Terselesaikan'");
            $table->text('keterangan')->nullable();
            $table->integer('status_aktif')->default(1);

            $table->foreign('idm_staff')->references('idm_staff')->on('m_staff');
            $table->foreign('iduser')->references('iduser')->on('m_user');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_pelaporan');
    }
};
