<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_jabatan', function (Blueprint $table) {
            $table->id('idjabatan');
            $table->text('nama');
            $table->integer('status_aktif')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_jabatan');
    }
};
