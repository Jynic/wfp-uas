<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_kota_kabupaten', function (Blueprint $table) {
            $table->id('idkota_kabupaten');
            $table->text('kode')->nullable();
            $table->text('nama')->nullable();
            $table->text('jenis')->nullable();
            $table->integer('status_aktif')->default(1);
            $table->unsignedBigInteger('m_provinsi_idprovinsi');

            $table->foreign('m_provinsi_idprovinsi')->references('idprovinsi')->on('m_provinsi');
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_kota_kabupaten');
    }
};
