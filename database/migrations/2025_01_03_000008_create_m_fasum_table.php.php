<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_fasum', function (Blueprint $table) {
            $table->id('idfasum');
            $table->unsignedBigInteger('m_dinas_iddinas');
            $table->text('nama')->nullable();
            $table->decimal('luas_fasum', 20)->nullable();
            $table->text('kondisi_fasum')->nullable();
            $table->text('asal_fasum')->nullable()->comment('APBN, APBD, Swasta');
            $table->text('lat')->nullable();
            $table->text('lng')->nullable();
            $table->text('gambar')->nullable();
            $table->integer('status_aktif')->default(1);

            $table->foreign('m_dinas_iddinas')->references('iddinas')->on('m_dinas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_fasum');
    }
};
