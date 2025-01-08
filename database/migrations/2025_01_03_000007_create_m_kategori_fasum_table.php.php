<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_kategori_fasum', function (Blueprint $table) {
            $table->id('idkategori_fasum');
            $table->text('nama');
            $table->integer('status_aktif')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_kategori_fasum');
    }
};
