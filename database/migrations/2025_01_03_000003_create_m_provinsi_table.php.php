<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_provinsi', function (Blueprint $table) {
            $table->id('idprovinsi');
            $table->text('kode')->nullable();
            $table->text('nama')->nullable();
            $table->integer('status_aktif')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_provinsi');
    }
};
