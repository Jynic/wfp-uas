<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_jenis_fasum', function (Blueprint $table) {
            $table->id('idjenis_fasum');
            $table->text('nama')->nullable();
            $table->integer('status_aktif')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_jenis_fasum');
    }
};