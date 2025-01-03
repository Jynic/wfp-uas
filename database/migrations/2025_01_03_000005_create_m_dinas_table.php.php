<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_dinas', function (Blueprint $table) {
            $table->id('iddinas');
            $table->unsignedBigInteger('idkota_kabupaten');
            $table->text('nama')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('status_aktif')->default(1);

            $table->foreign('idkota_kabupaten')->references('idkota_kabupaten')->on('m_kota_kabupaten');
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_dinas');
    }
};
